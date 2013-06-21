(function($){

	// jQuery plugin for the checklist generator interface
	// appEngine
 	$.fn.appEngine = function()
	{

 		var elem 		= $(this);
 		var objEngine 	= this;

		var scriptUrl	= "../index.php";

		var doc			= $(document);

		// Get specific actions from the server
 		var get 	= function(action)
		{
 			return $.ajax({
				url: scriptUrl,
				type: "post",
				data: {"action":action}
			});
 		};

		var send	= function(data)
		{
			return $.ajax({
				url:scriptUrl,
				type: "post",
				data: data
			});
		};
		
		objEngine.getHisElements =	function()
		{
			return elem.find("tr");
		};

		objEngine.addEntry		=	function()
		{
			
		};

		// Delete a specific data in the current element
		// And send the action in ajax
		objEngine.deleteEntry	=	function(id)
		{
			var toSend	=	new Array();
			
			toSend.push("action");
			toSend.push("del");
			toSend.push(id);

			send(toSend).done(function(data){
				alert(id);
				//elem.remove();	
			});	
		};

		// Refresh data in the current element
		// And send the action in ajax
 		objEngine.refresh	=	function()
		{
 				elem.html("");
 				get("fetch").done(function(data){
	 				elem.append(data);
					elem.delegate("td","selectRow", function(e){
							
						alert("id:" + this.id);
					});
	 				return false;
				});
 		};

		objEngine.ajaxReHandle = function(event, request, settings){
		   $("body").append( "<p> - Event : " + event + " request :" + request + " settings :" + settings + "</p>" );
		}
			
		elem.on("click", $("tr"), function(){
			alert("test" + $.contains(elem, $("tr")));
		});	


		objEngine.refresh();

		doc.ajaxComplete(objEngine.ajaxReHandle);

		return objEngine;
	};

})(jQuery);
