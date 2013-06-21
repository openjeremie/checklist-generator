//IIFE
(function(runjQueryApp){

 runjQueryApp(window.jQuery, window, document);

 }(function($, window, document){
	 // $ is now wrapped locally

	 $(function(){
		 // DOM is Ready
		 // Time to set events

		 var cAlert 	= $('.alert');
		 var cDelRowBt	= $('.delete-row-bt');
		 var cDelRow 	= $('.delete-row');
		 var cSelecRow	= $('.row-selected');
		 var cRefresh	= $('.refresh');
		 var cModDelRow = $('.modal-delete-row');

		 var iErrModal 	= $('#errorModal');
		 var iDisModal 	= $('#displayModal');

		 var adtModal 	= $('a[data-toggle="modal"]');

		 var bdtModal 	= $('button[data-toggle="modal"]');
		 var body		= $('body');

		 var list 		= $('#listContent').appEngine();


		 cAlert.alert();


		 cRefresh.on("click", list.getHisElements(), function(e){
		 		list.refresh();
			});


		 adtModal.on("click", function(e) {
				 var url = this.href;
				 if (url.indexOf('#') == 0) {
				 $(url).modal('open');
				 } else {
				 $.get(url, function(data) {
					 iDisModal.modal().append(data);
					 }).success(function() { $('input:text:visible:first').focus(); });
				 }
				 });

		 bdtModal.on("click", function(e){
				 $(".delete-" + $(this).data("delete")).addClass("row-selected");
				 iErrModal.modal();
				 });

		 cDelRow.on("click", function(e){
				 $(".row-selected").remove();
				 iErrModal.modal('hide');
				 });

		 iErrModal.on("hidden", function(){
				 $(".row-selected").removeClass("row-selected");
				 });

	

		$("tr").click(function(){
			list.trigger("selectRow");
		});
		// Delete a row
		//list.on("click", line.getHisElements(), function(){ 
		//	alert("click line - " + this.id);
		//});
		list.find("tr").each(function(){
			alert("lol");
			$(this).on("click", cDelRowBt, function(){
			alert($(this));
			//list.deleteEntry($(this));
		});
		});

		 cModDelRow.on("click", function(){
				 $.get('../tpl/modals/checklist.twig', function(data) {
					 iErrModal.modal();
					 }).success(function() { $('input:text:visible:first').focus(); });
				 });

	 });

 }));
