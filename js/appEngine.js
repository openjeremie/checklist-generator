(function($){
		//'arrivee' 	=> 'forward',
					//'depart'	=> 'backward',
					//			'mobilite'	=> 'retweet',
					//						'prolongation'	=> 'resize-horizontal',
														//'absence'	=> 'time'


	// jQuery plugin for the checklist generator interface
	// appEngine
 	$.fn.appEngine = function()
	{

 		var elem 		= $(this);
 		var objEngine 	= this;

		var scriptUrl	= "../index.php";

		var doc			= $(document);

		var debug		= false;

		var iErrModal 	= $('#errorModal');
		var bDelModal	= $('button.delete-row');
		var iDisModal 	= $('#displayModal');
		
		var aSynchr		= true;

		// Get specific actions from the server
 		var get 	= function(action)
		{
 			return $.ajax({
				url: scriptUrl,
				type: "post",
				data: {"action":action}
			});
 		};
		
		// Send data to server
		var send	= function(data)
		{
			return $.ajax({
				url:scriptUrl,
				type: "post",
				data: data,
				async: aSynchr
			});
		};
	
		// var_dump like
		var debugDump = function(obj)
		{
			var outRequest = "";

			for (var item in obj) {
				var type = typeof(obj[item]);
				outRequest += '[';
				outRequest += type;
				outRequest += '] : ';
				outRequest += item;
				outRequest += ' : ';
				if (type.indexOf("object") >= 0) {
					outRequest += debugDump(obj[item]);
				} else {
					outRequest += obj[item];
				}
				outRequest += '<br/>';
			}
			return outRequest;
		};
		
		// Réatache les événements aux éléments de la liste
		var reBindList	= function()
		{
			// Parcour chaque case td de chaque ligne tr
			elem.find("tr").children().each(function(){

				// Tooltip TODO FIND SOMETHING ELSE
				/*
				$(".complete-case div").children().each(function(){
					var tooltipHandle = $(this).find('a');

					 if (tooltipHandle.hasClass("tooltip")){
							tooltipHandle.bind('click', function(event){
								$(this).tooltip();
							});
					 }
				});
				*/
				// Autre cases
				$(this).bind('click', function(event){
					fEventList[$(this).attr("data-action")](this);
				});
			});
		};
		
		objEngine.getHisElements =	function()
		{
			return elem.find("tr");
		};

		objEngine.addEntry		=	function(el)
		{
			var nbEntry = elem.children().length + 1;

			var toSend	=	"action=add&";
			toSend += 'name=John+Doe&dep=DOS&tache=donner+un+bureau&type=';
			toSend += $('form').find('input[name="type"]').val();
			toSend += "&id=" + nbEntry;

			send(toSend).done(function(data){
				iDisModal.modal('hide');
				elem.prepend(data);
				reBindList();
			});
		};

		objEngine.editEntry		=	function(el)
		{
			alert("edit pop-up : " + el.id);	
		};

		// Delete a specific data in the current element
		// And send the action in ajax
		objEngine.deleteEntry	=	function(el)
		{
			
			iErrModal.modal();
			
			aSynchr = false;
			bDelModal.on("click", function(){
			
				var toSend	= "action=del&id=" + el.id;
		
				send(toSend).done(function(data){
					$('#'+el.parentElement.id).remove();
					aSynchr = true;
					iErrModal.modal('hide');
				});	
			});
		};

		// Send the action in ajax
		// and refresh data in the current element
 		objEngine.refresh	=	function()
		{
 				elem.html("");
 				get("fetch").done(function(data){
	 				elem.append(data);
					reBindList();
				});
	 			return false;
 		};

		
		objEngine.refreshEventElement	=	function(el)
		{
			el.on("click", objEngine.getHisElements(), function(e){
				objEngine.refresh();
			});
		};

		objEngine.addEventElement		=	function(el)
		{
			el.find("li a").each(function(){

				$(this).bind('click', function(e){
					var name = $(this).attr("href");

					var toSend = "action=getmodal&name="+name;
				
					send(toSend).done(function(data){
						iDisModal.html("");
						iDisModal.modal().append(data);
						$(".modal-footer .btn-primary").bind('click', function(e){
							fEventList['add'](iDisModal);	
						});
					}).success(function(){
						$('input:text:visible:first').focus(); 
					});
				});
			});
		};
		
		objEngine.ajaxDebug 			= function(event, request, settings){
		   $("#debug").prepend( '<p class="debug">[DEBUG AJAX] <br/>request status : ' + request.status + ' <br/> var : ' + settings.data  + '</p>' );
		};
			
		doc.ajaxComplete(function(e, r, s){
			if (debug){
				objEngine.ajaxDebug(e, r, s);
			}
		});

		var fEventList	= {
			"delete" 	: objEngine.deleteEntry,
			"edit"		: objEngine.editEntry,
			"add"		: objEngine.addEntry
		};
		
		objEngine.refresh();
		
		return objEngine;
	};

})(jQuery);
