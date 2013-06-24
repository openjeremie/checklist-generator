(function($){

	// jQuery plugin for the checklist generator interface
	// appEngine
 	$.fn.appEngine = function()
	{

 		var elem 		= $(this);
 		var objEngine 	= this;

		var scriptUrl	= "../index.php";

		var doc			= $(document);

		var debug		= true;

		var iErrModal 	= $('#errorModal');
		var bDelModal	= $('button.delete-row');

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

		objEngine.getHisElements =	function()
		{
			return elem.find("tr");
		};

		objEngine.addEntry		=	function(el)
		{
			
		};

		objEngine.editEntry		=	function(el)
		{
			alert("edit " + el.id);	
		};

		// Delete a specific data in the current element
		// And send the action in ajax
		objEngine.deleteEntry	=	function(el)
		{
			
			iErrModal.modal();
			
			aSynchr = false;
			bDelModal.on("click", function(){
			
				var toSend	=	[];
		
				toSend.push(["action","del"]);
				toSend.push(["id", el.id]);

				send(toSend).done(function(data){
				$('#'+el.parentElement.id).remove();
					aSynchr = true;
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
					elem.find("tr").children().each(function(){
						$(this).bind('click', function(event){
							fEventList[$(this).attr("data-action")](this);
						});
					});
				});
	 			return false;
 		};

		objEngine.ajaxDebug = function(event, request, settings){
		   $("#debug").prepend( '<p class="debug">[DEBUG AJAX] <br/>request status : ' + request.status + ' <br/> var : ' + settings.data  + '</p>' );
		}
			
		doc.ajaxComplete(function(e, r, s){
			if (debug){
				objEngine.ajaxDebug(e, r, s);
			}
		});

		var fEventList	= {
			"delete" 	: objEngine.deleteEntry,
			"edit"		: objEngine.editEntry
		};
		
		objEngine.refresh();
		
		return objEngine;
	};

})(jQuery);
