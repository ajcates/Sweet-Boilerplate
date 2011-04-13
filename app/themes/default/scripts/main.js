
try {
	var c = console;
} catch (E) {
	var c = {log: function() {}}
}

/*
$ = jQuery
jq = "#data"
*/
(function($, jq) {
	$.jgrid.no_legacy_api = true;
	$.fn.extend({
		insertComment: function(comment) {
		//	
			return this.each(
				function() {
					if(!isArray(comment)) {
						comment = [comment];
					}
					elem = this;
					$.each(
						comment,
						function() {
							$(elem).prepend(
								$("<div>", {id:"comment-" + this.id}).append($("<h3>").text(this.userId.lastName + ", " + this.userId.firstName), $("<p>").text(this.comment ) )
							);
						}
					);
					return this;
					//this.prepend()
				}
			);
			//return this;
		},
		insertForm: function(config) {
			return ($.extend({
				init: function(elem) {
					elem.submit(function(e) {
						var insertValue = $("#insert-form").find("input[type=text]").val();
						if(insertValue) {
							var data = new Object();
							data[$(document).data("currentModel").pk.name] = insertValue;
							$.createRow(data, $.proxy(
								function() {
									$.jGrowl("Data has been inserted successfully");
									
									
									
									
									//$(jq).jqGrid("resetSelection");
									//c.log($(jq).data());
									c.log("jq.current");
									c.log($(jq).data("current"));
									c.log("changed cells");

									//c.log();
									//$(jq).jqGrid("getChangedCells");
									//c.log("getChangedCells");
									
									$(jq).jqGrid("addRowData", this[$(document).data("currentModel").pk.name], this, "first");
									
									$(jq).jqGrid("setSelection", this[$(document).data("currentModel").pk.name]);
									//$(jq).jqGrid("editCell", 0, 0, false);
								},
								data
							));
							$("#insert-form").dialog("close");
						}
						return false;
					});
					return elem;
				}
			}, config)).init(this);
		}
	});
	$.extend({
		createRow: function(row, success) {
			c.log("row");
			c.log(row);
			$.each(row, function(pkLabel, pkValue) {
				$.ajax({
					url: $(document).data("SiteURL") + "create/" + $(document).data("currentModel").name,
					type: "POST",
					error: function(XMLHttpRequest, textStatus, errorThrown) {
						$.jGrowl("Insert Failed");
					},
					success: success,
					data:  {
						id: pkValue
					}
				});
			});
		},
		loadDialogData: function(table) {
			//
			c.log("connectedModels");
			if($(document).data("commentsLoaded") != $(jq).data("currentRow")) {
				//$(document).data("commentsLoaded", $(jq).data("currentRow"));
				$("#comments-list").empty();
			}
			//c.log($(document).data("connectedModels")[0].name);
			if(table) {
				this.table = table;	
			} else {
				if(!this.table) {
					this.table = $("#advance-item-options li.ui-tabs-selected a").attr("name");
				}
			}
			var table = this.table;
			$.jGrowl("Loading " + $(jq).data("current").rowid);
			
			$("#advance-item-options .good").removeClass("good");
			$("#advance-item-options .error").removeClass("error");
			$.getJSON(
				$(document).data("SiteURL") + "read/" + this.table + "/" + $(jq).data("current").rowid,
					function(response) {
						c.log("this.table");
						c.log(table);
						for(p in response[0]) {
							$("#" + table + "-" + p).val(response[0][p]);
						}
					}
			);
		}
	});
	$(document).ready(function() {
		//data…
		$(document).data("connectedModels", {});
		$(jq).data("current", {});
		
		/*
c.log("$(div.main).width()");
		c.log($("div.main").width());
		
		$("#jqGrid").css("width", $("div.main").width());
*/
		
		$(jq).data("jqGrid", {
			datatype : "json",
			mtype : "POST",
			autowidth : true,
			cellsubmit : "remote",
			sortorder : "asc",
			caption : $(document).data("currentModel").label,
			gridview : true,
			height : 250,
			multiselect : false,
			scroll : true,
			pager: "pager",
			viewrecords: true,
			lastRow : null,
			currentRow: null,
			nextRow: null,
			rowNum: 20,
			selectedCell: null,
			cellEdit: true,
			savedCell: null,
			lastContent: null,
			shrinkToFit: false,
			onHeadClick: function(e) {
				/*
				grid.base.js line 1371ish with a click()
				if(ts.p.onHeadClick) {
					if(!ts.p.onHeadClick(e)) {
						return false;
					}
				}
				
				grid.celledit.js line 240ish with a $.isFunction
				if(!$t.p.errorCell(res,stat)) {
					$($t).jqGrid("restoreCell",iRow,iCol);
				} else {
					$t.p.savedRow.splice(0,1);
				}
				
				*/
				c.log("E");
				c.log(e);
				
				var cRow = $(jq).data("current");
				if(typeof(cRow.row) != undefined && typeof(cRow.cell) != undefined) {
					$(jq).jqGrid("restoreCell", cRow.row, cRow.cell);
				}
				
				//$(jq).jqGrid("restoreCell", $(jq).data("current").row, $(jq).data("current").cell);
				return true;
			},
			ondblClickRow: function(rowid, iRow, iCol, e) {
				/* START Building of advance options */
				/*
				var connectedTables = $(document).data("currentModel").connectedTables;
				$("#advance-item-options .good").removeClass("good");
				$("#advance-item-options .error").removeClass("error");
				*/
				$.loadDialogData(); //fill her up…
				$("#advance-item-options").dialog({
					title: "Editing " + rowid,
					width: 800,
					modal: true
				});
			},
			beforeEditCell: function(rowid, cellname, value, iRow, iCol) {
				return true;
			},
			formatCell: function(rowid, cellname, value, iRow, iCol) {
				$(jq).data("current", {
					row: iRow,
					cell: iCol,
					rowid: rowid,
					cellname: cellname
				});
			},
			onSelectCell: function(rowid, cellname, value, iRow, iCol) {
				$(jq).data("current", {
					row: iRow,
					cell: iCol,
					rowid: rowid,
					cellname: cellname
				});
				return true;
			},
			beforeSaveCell: function(rowid, cellname, value) {
				var cell;
				$(this.colModel).each(function(i) {
					if(this.name == cellname) {
						cell = "#" + rowid + " td:eq("+i+")";
						return false;
					}
				});
				
				this.savedCell = cell;
				this.lastContent = value;
				
				//$(jq).data("current", {});
				/*
this.currentRow = null;
				this.currentCell = null;
*/
			},
			afterSaveCell: function() {
				//saveCell
				$.jGrowl("Cell Has Been Saved");
				if($(this.savedCell).hasClass("error")) {
					$(this.savedCell).removeClass("error", "normal", "linear", function() {
						$(this).addClass("good", "normal");
					});
				} else {
					$(this.savedCell).addClass("good", "normal");
				}
				
				
			},
			cellurl: $(document).data("SiteURL") + "edit/" + $(document).data("currentModel").name,
			errorCell: function(response, status) {
				$(this.savedCell).addClass("error", "normal").text(this.lastContent).removeClass("edit-cell");
				return true;
			},
			beforeSelectRow: function(rowid) {
				$(jq).data("currentRow", rowid);
				return true;
			}
		});
		
		//shit i gotta do…
		$("#insert-form").hide().insertForm().find("input[type=text]").input({
			validation: true,
			rules: {}
		});
		$("#insert-form label").text($(document).data("currentModel").pk.label);
		
		//building the advance options @todo store this in a fucntion so i can execute it when stuff is done
		var connectedTables = $(document).data("currentModel").connectedTables;
		$("body").append($("<div>", {id:"advance-item-options"})).find("#advance-item-options").hide().append($("<ul>", {id:"advance-item-options-tabs"}));
		var getCount = 0;
		for(i in connectedTables) {
			$.get(
				$(document).data("SiteURL") + "info/" + connectedTables[i],
				function(json) {
					eval("var gridders = " + json);
					var currentlyConnectedModels = $(document).data("connectedModels");
					currentlyConnectedModels[gridders.name] = gridders;
					
					$(document).data("connectedModels", currentlyConnectedModels);
					
					
					if(connectedTables.length <= ++getCount) {
						//@todo make this happen all in one ajax call.
						var eachCount = 0;
						$.each(currentlyConnectedModels, function(i, model) {
							$("#advance-item-options-tabs").append($("<li>").append(
								$("<a>", {href: "#" + this.name, name: this.name}).text(this.label)
							));
							form = $("<section>", {id:this.name}).append($("<form>")).appendTo("#advance-item-options").find("form");
							$.each(this.jqGrid.colModel, function(j) {
								var id = model.name + "-" + this.name;
								//@todo add in the logic to draw out the select statments and stuff
								form.append($("<fieldset>")).find("fieldset").eq(j).addClass("ui-widget-content ui-corner-all").append(
									$("<label>", {"for": id}).text(this.label)
								).append(
									$("<input>", {id: id, name: id})
								);
							});
							if(connectedTables.length <= ++eachCount) {
								//start building notes
								$("#advance-item-options-tabs").append($("<li>").append(
									$("<a>", {href: "#comments", name: "comments"}).text("Comments")
								));
								$("#advance-item-options").append(
									$("<section>", {id: "comments"}).append(
										$("<form>").append(
											$("<fieldset>").append(
												$("<textarea>", {id:"comment-text"}),
												$("<input>", {type: "submit", value: "Add A Comment"})
											)										
										).submit(function() {
											c.log("Comment Submitted");
											c.log($("#comment-text").val());
											//
											$.post(
												$(document).data("SiteURL") + "postComment/" + $(document).data("currentModel").name + "/" + $(jq).data("currentRow"),
												{comment:$("#comment-text").val()},
												function(response) {
													c.log("Comment posted response");
													c.log(response);
													
													$("#comments-list").insertComment(response);
													/*
$("#comments-list").prepend(
														$("<h2>").text
													)
*/
												},
												"json"
											);
											return false;
										})
									).append(
										$("<div>", {id:"comments-list"})
									)
								);							
								//form.append($()
								//end building notes
								
								$("#advance-item-options").tabs({
									select: function(event, ui) {
										if(ui.tab.name == "comments") {
											//$.loadComments(ui)
											if($(document).data("commentsLoaded") != $(jq).data("currentRow")) {
												$(document).data("commentsLoaded", $(jq).data("currentRow"));
												$("#comments-list").empty();
												$.get(
													$(document).data("SiteURL") + "getComments/" + $(document).data("currentModel").name + "/" + $(jq).data("currentRow"),
													function(comments) {
														c.log("Comments");
														c.log(comments);
														$("#comments-list").insertComment(comments);		
													},
													"json"
												)
											}											
										} else {
											$.loadDialogData(ui.tab.name);
										}
									}
								});
								//@todo trigger something instead.
							
								$("#advance-item-options input").input({validation: true, rules: {}}).change(function(e) {
									//c.log();
									var id = $(e.currentTarget).attr("id").split("-");
									c.log("id");
									c.log(id);
									
									var data = new Object();
									data["id"] = $(jq).data("current").rowid;
									data[id[1]] = $(e.currentTarget).val();
									$.ajax({
										url: $(document).data("SiteURL") + "edit/" + id[0],
										type: "POST",
										success: function(response) {
											$.jGrowl("Successful Update");
											if($(e.currentTarget).hasClass("error")) {
												$(e.currentTarget).removeClass("error", "normal", "linear", function(e) {
													c.log("callback");
													c.log(e);
	//												c.log();
													$(this).addClass("good", "normal");
												});
											} else {
												$(e.currentTarget).addClass("good", "normal");
											}
											
										},
										error: function(XMLHttpRequest, status, error) {
											c.log("status");
											c.log(status);
											c.log("error");
											c.log(error)
											$.jGrowl("Failful Update");	
											$(e.currentTarget).removeClass("good", "normal", "linear", function() {
												$(this).addClass("error", "normal");
											});
											//$(e.currentTarget).addClass("error", "normal");
											
											//$(e.currentTarget).closest(".ui-widget").addClass("error", "normal");
										},
										data: data
									});
									
								});
							}
						});
					}
				}
			);
		}
		
		//events…
		$("#delete").click(function() {
			$("#" + $(jq).data("currentRow")).addClass("error", "normal"); //@todo figure out if this is needed
			// code for comfirm delete goes here	
			if($(jq).data("currentRow") !== undefined) {
				$("<form>", {id: "delete-popup"}).append($("<p>").text("Are you sure you want to delete " + $(jq).data("currentRow") + "?")).dialog({
					title: "Delete " + $(jq).data("currentRow"),
					width: 380,
					buttons: {
						'Delete': function() {
							$.ajax({
								url: $(document).data("SiteURL") + "delete/" + $(document).data("currentModel").name + "/" + $(jq).data("currentRow"),
								error: function(XMLHttpRequest, textStatus, errorThrown) {
									c.log("error found");
								},
								success: function(response) {
									c.log('response');
									c.log(response);
									$("#" + $(jq).data("currentRow")).slideUp();
									$.jGrowl($(jq).data("currentRow") + " has been deleted.");
								}
							});
						},
						Cancel: function() {
							$(this).dialog("destroy");
							$("#delete-popup").remove();
						}
					}
				});
			} else {
				$.jGrowl("Please select a row first");
			}
			return false;
		});
		
		$("#insert").click(function() {
			$(jq).jqGrid("resetSelection");
			var cRow = $(jq).data("current");
			c.log(typeof(cRow.row));
			if(typeof(cRow.row) != undefined && typeof(cRow.cell) != undefined) {
				$(jq).jqGrid("restoreCell", cRow.row, cRow.cell);
			}
			
			$("#insert-form").dialog({
				title: "Insert a new " + $(document).data("currentModel").label,
				width: 380,
				buttons: {
					Insert: function() {
						if($("#insert-form").find("input[type=text]").val()) {
							$("#insert-form").submit();
						}
					},
					Cancel: function() {
						$(this).dialog("close");
					}
				}
			});
			return false;
		});
		$("#edit").click($(jq).data("jqGrid").ondblClickRow);
	});
})(jQuery, "#data");