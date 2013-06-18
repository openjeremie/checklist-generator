(function($){


 	$.fn.appEngine = function()
	{

 		var elem 		= $(this);
 		var objEngine 	= this;

		var scriptUrl	= "../index.php";

 		var get 	= function()
		{
 			return $.ajax({
				url: scriptUrl,
				type: "post",
				data: {"action":"fetch"}
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
			return elem.find("tr").find("td");
		};

		objEngine.addEntry		=	function()
		{
			
		};

		objEngine.deleteEntry	=	function(id)
		{
			var toSend	=	new Array();
			
			toSend.push("action");
			toSend.push("del");
			toSend.push(id);

			send(toSend).done(function(data){
				alert(data);
				//elem.remove();	
			});	
		};

 		objEngine.refresh	=	function()
		{
 				elem.html("");
 				get().done(function(data){
	 				elem.append(data);
	 				return false;
				});
 		};
	
		objEngine.refresh();

		return objEngine;
	};

})(jQuery);
