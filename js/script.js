//IIFE
(function(runjQueryApp){

 runjQueryApp(window.jQuery, window, document);

 }(function($, window, document){
	 // $ is now wrapped locally

	 $(function(){
		 // DOM is Ready
		 // Time to set events

		 var cAlert 	= $('.alert');
		 var cRefresh	= $('.refresh');

		 var adtModal 	= $('.dropdown-menu');

		 var list 		= $('#listContent').appEngine();

		 list.refreshEventElement(cRefresh);
		 list.addEventElement(adtModal);

		 cAlert.alert();
	 });

 }));
