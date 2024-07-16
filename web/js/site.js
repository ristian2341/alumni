window.onload = function(){
	/** remove input page-size */
	if(!$(".summary").length){
		$(".pagesize").remove();
	}
}

var _is = {
	navbarTop: false, // status menu navbar top active or non active
};

var site = {
	init: function() {
		// init login
		site.login();
		// cek browser type
		if(checker.browserType() == "Firefox")
			$(".navbar-menubody").find("a[data-slug]").css({display: "inline-block"});
		// init after PJAX
		afterPjax();
		// add active menu
		navigasi.activeMenu();

		var $dataSlide = $(".navbar-left").attr("data-slide"),
			readmore = $("#pjax-container tbody").find("[data-readmore]");
		// data readmore
		readmore.removeClass("readmore").addClass("readmore");
		$.each($("[data-readmore]"), function(index, element){
			if($(element).next("a[data-show]").length < 1 && $(element).text().length > 25){
				$(element).after("<a href=\"javascript:void(0)\" data-show />");
			}
		});
		$("a[data-show]").attr("data-show", "open");
		
		if($dataSlide == "hide") {
			$(".navbar-left").removeClass("navbar-collapse").addClass("navbar-collapse");
			$(".navbar-slidebutton > .fontello").removeClass("icon-angle-double-left").addClass("icon-angle-double-right");
			$(".container").addClass("container-collapse");
		} else {
			$(".navbar-left").removeClass("navbar-collapse").addClass("animation slidein-left");
			$(".navbar-slidebutton > .fontello").removeClass("icon-angle-double-right").addClass("icon-angle-double-left");
			$(".container").removeClass("container-collapse");
		}
	},
	login: function() {
		$("#request-password-reset-form").addClass("mt30");
		$(".smooth-field").addClass("has-value");
		$(".smooth-field").each(function(index, element){
			$(this).on("blur", function(){
				if($(this).val().trim() != "")
					$(this).addClass("has-value");
				else
					$(this).removeClass("has-value");
			});
		});
		// form nya minta bisa digeser
		$(".login-container").drag();
	}
};

var navigasi = {
	// function loading saat add to menu favorite
	process: function(params) {
		if(params == "load") {
			var content = "<div class=\"loading-layer\"><div id=\"loading_id\"></div></div>";
			$(content).appendTo(".navbar-favoritebody");
			$("#loading_id").loader("load", {left:-125, top:80});
		} else if(params == "destroy") {
			$("#close_properties").trigger("click");
			$("#loading_id").loader("destroy");
			$(".loading-layer").remove();
		}
	},
	// add class active in menu active
	activeMenu: function() {
		var path = window.location.href,
			pathSplit = path.split("%")[0] +'%'+ path.split("%")[1];

		$(".navbar-menubody .navbar-menu a[data-menu]").each(function(index, element){
			var _this=$(this);
			if(this.href === path || (this.href === pathSplit
				&& window.location.search !== "?r=pengaturan%2Fpenerimaan%2Fopen-edit"
				&& window.location.search !== "?r=product%2Fproduct%2Fproduct")
			) {
				_this.closest(".navbar-menu").addClass("active");
				$(".navbar-menubody").scrollTop((_this.offset().top - ($(".navbar-menubody").height() - $(".navbar-menubody").offset().top)));
			}
		});
	},
	// change status (0: hide, 1: show)
	slideMenu: function(value) {
		$.ajax({
			type: "POST",
			url: location.pathname+"?r=favorite/slidemenu",
			data: {
				"Favorite[menu_slide]": value,
				"Favorite[data_type]": "slide-menu",
			},
			dataType: "text",
			error: function(xhr, errors, message) {
				console.log(xhr, errors, message);
			},
			success: function(data) {
				$(".navbar-left").attr("data-slide", (value == 1 ? 'show' : 'hide'));
			}
		});
	}
};

var afterPjax = function() {
	// width td action
	$.each($("table > tbody tr td.btn-display"), function(index, element) {
		var len = $(element).find(".btn").length,
			_outerWidth = $(element).find(".btn").outerWidth(),
			$dataShape = $(element).find(".btn[data-shape]");
		if($dataShape.attr("data-shape") == "rectangular"){
			var ceils = Math.ceil($dataShape.outerWidth());
			$(element).width((_outerWidth*len)+ceils);
		} else{
			$(element).width((_outerWidth*len)+15);
		}
	});
};

// check empty field
var isempty = function(attribute, pattern){
	var message = "",
		success = true;
	$.each(attribute, function(index, element){
		if(!$(element).val()){
			success = false;
			var attrID = $(element).attr("id"),
				attr_replace = attrID.replace(pattern,"").replace("_", " ");
			message += parsing.toUpper(attr_replace, 2) + ', ';
		}
	});
	return { success: success, message: message +' Cannot be Blank!' };
};

$(document).ajaxStart(function(){
	// nothing something todo
}).ajaxStop(function(){
	afterPjax();
});

$(document).ready(function() {
	/** reset all element a that have a child menu */
	$(".navbar-menu a i[data-parent]").each(function(i, e) {
		$(e).parent().attr("data-disabled", "disabled");
	});
	$("a[data-disabled]").each(function(i, e) {
		$(e).attr("href", "javascript:void(0)");
	});
	/** end reset all element a that have a child menu */

	/** bypass icons dashboard */
	$(".navbar-menu a").find("span:contains('Dashboard')")
		.prev(".fontello")
		.removeClass("icon-doc-text-inv")
		.addClass("icon-home-2");

	/** autocomplete off */
	$("input[type=\"text\"]").attr("autocomplete", "off");

	// init function from site.js
	site.init();
	// end init function from site.js

	/** event toggle class menu
		** 1). menu collapse navigasi kiri
		** 2). menu collapse navigasi versi mobile
		** 3). menu navigasi kiri
		** 4). menu navigasi kiri kalau klik nama menu
		** 5). menu navigasi atas
		** 6). tutup menu navigasi atas kalau click setiap element yg ada dalam document / body
	*/
	// 1). menu collapse navigasi kiri
	$("body").off("click",".navbar-slidebutton > .fontello").on("click",".navbar-slidebutton > .fontello", function(e) {
		e.preventDefault();
		var _this=$(this),
			navSlide = $(".navbar-left").attr("data-slide");

		if(_this.hasClass("icon-angle-double-left")) {
			$(".navbar-left").removeClass("navbar-collapse").removeClass("animation slidein-left slideout-left").addClass("animation slideout-left");
			_this.removeClass("icon-angle-double-left").addClass("icon-angle-double-right");
			$(".container").addClass("container-collapse");
			// navigasi.slideMenu(0);
		} else {
			$(".navbar-left").removeClass("navbar-collapse").removeClass("animation slideout-left slidein-left").addClass("animation slidein-left");
			_this.removeClass("icon-angle-double-right").addClass("icon-angle-double-left");
			$(".container").removeClass("container-collapse");
			// navigasi.slideMenu(1);
		}
	});
	// 2). menu collapse navigasi versi mobile
	$("body").off("click",".navbar-togglemobile").on("click",".navbar-togglemobile", function(e) {
		e.preventDefault();
		_this=$(this);
		$(".navbar-leftmobile").toggleClass("open");
		if($(".navbar-leftmobile").hasClass("open")) {
			$(".navbar-leftmobile").slideDown();
			$("[data-role=\"toggle-topmenu\"]").next().removeClass("open");
			$("[data-role=\"toggle-topmenu\"]").next().hide();
		} else {
			$(".navbar-leftmobile").slideUp();
			$("[data-role=\"toggle-topmenu\"]").next().removeClass("open");
			$("[data-role=\"toggle-topmenu\"]").next().hide();
		}
	});
	// 3). menu navigasi kiri
	$("body").off("click","[data-role=\"toggle-menu\"]").on("click","[data-role=\"toggle-menu\"]", function(e) {
		e.preventDefault();
		var $dataParent = $(this).attr("data-parent");
		_this=$(this);

		_this.closest(".navbar-menu").toggleClass("open");
		if(_this.closest(".navbar-menu").hasClass("open")) {
			_this.removeClass("icon-plus-squared-alt").addClass("icon-minus-squared-alt");
			_this.next().removeClass("icon-folder-3").addClass("icon-folder-open-2");
			if($dataParent == 1) {
				_this.closest(".navbar-menu").find(".navbar-menu-tree[data-toggle=\"first-child\"]").show();
			} else if($dataParent == 2) {
				_this.closest(".navbar-menu").find(".navbar-menu-tree[data-toggle=\"twice-child\"]").show();
			}
		} else {
			_this.removeClass("icon-minus-squared-alt").addClass("icon-plus-squared-alt");
			_this.next().removeClass("icon-folder-open-2").addClass("icon-folder-3");
			_this.closest(".navbar-menu").find(".navbar-menu-tree").hide();
			if($dataParent == 1) {
				// reset class open yang ada di navbar-menu-tree
				$(".navbar-menu-tree .navbar-menu").removeClass("open");
				// reset default
				$("[data-role=\"toggle-menu\"]:not([data-parent=\"1\"])").removeClass("icon-minus-squared-alt").addClass("icon-plus-squared-alt");
				$("[data-role=\"toggle-menu\"]:not([data-parent=\"1\"])").next().removeClass("icon-folder-open-2").addClass("icon-folder-3");
			}
		}
	});
	// 4). menu navigasi kiri kalau klik nama menu
	$("body").off("click","a[data-disabled] > span").on("click","a[data-disabled] > span", function(e) {
		e.preventDefault();
		var $dataParent = $(this).siblings("[data-parent]").attr("data-parent");
		_this=$(this).siblings("[data-parent]");
		_this.closest(".navbar-menu").toggleClass("open");
		if(_this.closest(".navbar-menu").hasClass("open")) {
			_this.removeClass("icon-plus-squared-alt").addClass("icon-minus-squared-alt");
			_this.next().removeClass("icon-folder-3").addClass("icon-folder-open-2");
			if($dataParent == 1) {
				_this.closest(".navbar-menu").find(".navbar-menu-tree[data-toggle=\"first-child\"]").show();
			} else if($dataParent == 2) {
				_this.closest(".navbar-menu").find(".navbar-menu-tree[data-toggle=\"twice-child\"]").show();
			}
		} else {
			_this.removeClass("icon-minus-squared-alt").addClass("icon-plus-squared-alt");
			_this.next().removeClass("icon-folder-open-2").addClass("icon-folder-3");
			_this.closest(".navbar-menu").find(".navbar-menu-tree").hide();
			if($dataParent == 1) {
				// reset class open yang ada di navbar-menu-tree
				$(".navbar-menu-tree .navbar-menu").removeClass("open");
				// reset default
				$("[data-role=\"toggle-menu\"]:not([data-parent=\"1\"])").removeClass("icon-minus-squared-alt").addClass("icon-plus-squared-alt");
				$("[data-role=\"toggle-menu\"]:not([data-parent=\"1\"])").next().removeClass("icon-folder-open-2").addClass("icon-folder-3");
			}
		}
	});
	// 5). menu navigasi atas
	$("body").off("click","[data-role=\"toggle-topmenu\"]").on("click","[data-role=\"toggle-topmenu\"]", function(e){
		e.preventDefault();
		_this=$(this);
		_this.next().toggleClass("open");
		if(_this.next().hasClass("open")) {
			// hidden all top menu that opening
			$("[data-role=\"toggle-topmenu\"]").next().removeClass("open");
			$("[data-role=\"toggle-topmenu\"]").next().hide();
			// open that click
			_this.next().addClass("open");
			_is.navbarTop = true;
			_this.next().show();
		} else {
			_is.navbarTop = false;
			_this.next().hide();
		}
	});
	// 6). tutup menu navigasi atas kalau click setiap element yg ada dalam document / body
	$("body").click(function(e) {
		var _target = $(e.target);
		if(!_target.is("[data-role] span") && !_target.is("[data-role]")) {
			if(is.screen == "dekstop_version") {
				if(_is.navbarTop == true) {
					$("[data-role=\"toggle-topmenu\"]").next().hide();
					$("[data-role=\"toggle-topmenu\"]").next().removeClass("open");
					_is.navbarTop = false;
				}
			}
		}
		// close properties
		$(".navbarto-favorite").hide();
		// close enter complete
		$(".enter-complete").hide();
		$(".enter-complete").empty();
	});
	/** end event toggle class menu */

	/** event search list menu */
	$("body").off("input","[data-search=\"menu\"]").on("input","[data-search=\"menu\"]", function(e) {
		e.preventDefault();
		var val = $.trim($(this).val()).replace(/ +/g, " ").toLowerCase(),
			$container;
		if(is.screen == "dekstop_version") {
			$container = ".navbar-menu-container";
		} else if(is.screen == "mobile_version") {
			$container = ".navbarmenu-containermobile";
		}

		$.each($(this).parents(".navbar-menusearch").siblings($container).find(".navbar-menu"), function() {
			$(this).show().filter(function(){
				var result = $(this).text().toLowerCase();
				// var result = $(this).text().replace(/\s+/g, "").toLowerCase();
				return !~ result.indexOf(val);
			}).hide();
		});
	});
	/** end event search list menu */

	/** event selectable menu to favorite menu
		** 1). event open properties window favorite
		** 2). event add to menu favorite
		** 3). event delete to menu favorite
		** 4). close properties favorite window
		** 5). event draggable and droppable add to menu favorite
		** 6). event copy link address
	*/
	// 1). event open properties window favorite
	$("body").off("contextmenu",".navbar-menu a:not([data-disabled]):not(:contains('Dashboard'))");
	$("body").on("contextmenu",".navbar-menu a:not([data-disabled]):not(:contains('Dashboard'))", function(e) {
		var _this = $(this);
		if(is.screen !== "mobile_version") {
			// turn on properties only on dekstop / tablet version
			e.preventDefault();
		}

		if(_this.attr("data-type") == "favorite") {
			$("#addto_favorite").closest("li").hide();
			$("#delete_favorite").closest("li").show();
		} else {
			$("#addto_favorite").closest("li").show();
			$("#delete_favorite").closest("li").hide();
		}

		if(e.which === KEY.CLICKRIGHT || e.keyCode === KEY.CLICKRIGHT) {
			$(".navbarto-favorite").show();
			_is.properties = true;
			// define properties position
			$(".navbarto-favorite").css({left: _this.offset().left + _this.outerWidth()-15});
			var _scroll = _this.offset().top - $(window).scrollTop();
			if(_scroll < 540) {
				$(".navbarto-favorite").css({top: _scroll});
			} else {
				$(".navbarto-favorite").css({top: _scroll - $(".navbarto-favorite").outerHeight()});
			}

			// manipulate attributes
			$("#addto_favorite")
				.attr("data-menu", _this.attr("data-menu"))
				.attr("data-slug", _this.attr("data-slug"));
			$("#delete_favorite")
				.attr("data-menu", _this.attr("data-menu"))
				.attr("data-key", _this.closest("li").attr("data-key"));
			$("#open_newtab").attr("href", _this.attr("href"));
			$("#copylink_address").attr("data-copy", _this.attr("href"));
		}
	});
	// 2). event add to menu favorite
	$("body").off("click","#addto_favorite").on("click","#addto_favorite",function(e) {
		e.preventDefault();
		var _this = $(this),
			desc = parsing.toUpper(_this.attr("data-slug").replace(/\-/g, " "), 2);
		$.ajax({
			type: "POST",
			url: location.pathname+"?r="+_this.attr("data-href"),
			data: {
				"Favorite[menu_id]": _this.attr("data-menu"),
				"Favorite[data_type]": "favorite",
			},
			dataType: "text",
			error: function(xhr, errors, message) {
				console.log(xhr, errors, message);
			},
			beforeSend: function() {
				navigasi.process("load");
			},
			success: function(data) {
				if(!$.trim(data)) {
					notification.open("danger", "Menu "+ desc +" sudah ada di Favorite.", 2000);
				} else {
					$(".navbar-favoritebody").html(data);
					notification.open("success", "Menu "+ desc +" berhasil ditambah ke Favorite.", 2000);
				}
			},
			complete: function() {
				navigasi.process("destroy");
			}
		});
	});
	// 3). event delete to menu favorite
	$("body").off("click","#delete_favorite").on("click","#delete_favorite", function(e) {
		e.preventDefault();
		var _this = $(this);
		$.ajax({
			type: "POST",
			url: location.pathname+"?r="+_this.attr("data-href"),
			data: {
				key: _this.attr("data-key"),
			},
			dataType: "text",
			error: function(xhr, errors, message) {
				console.log(xhr, errors, message);
			},
			beforeSend: function() {
				navigasi.process("load");
			},
			success: function(data) {
				$(".navbar-favoritebody").html(data);
			},
			complete: function() {
				navigasi.process("destroy");
			}
		});
	});
	// 4). close properties favorite window
	$("body").off("click","#close_properties").on("click","#close_properties", function(e) {
		e.preventDefault();
		$(".navbarto-favorite").hide();
	});
	// 5). event draggable and droppable add to menu favorite
	$(".navbar-menu").draggable({
		appendTo: ".navbar-favoritebody ul",
		axis: "y",
		containment: ".navbar-left",
		handle: "a:not([data-disabled]):not([data-type='favorite']):not(:contains('Dashboard'))",
		helper: "clone",
		start: function(ev, ui) {
			$("body").prepend("<div class=\"ondrag\"></div>");
			var _this = $(this);
			_this.find("a").attr("data-href","favorite/create");
		},
		stop: function(ev, ui) {
			$(".ondrag").remove();
		}
	});
	$(".navbar-favorite-container .navbar-favoritebody").droppable({
		drop: function(ev, ui) {
			var _this = $(ui.draggable),
				desc = parsing.toUpper(_this.find("a").attr("data-slug").replace(/\-/g, " "), 2);

			$.ajax({
				type: "POST",
				url: location.pathname+"?r="+_this.find("a").attr("data-href"),
				data: {
					"Favorite[menu_id]": _this.find("a").attr("data-menu"),
					"Favorite[data_type]": "favorite",
				},
				dataType: "text",
				error: function(xhr, errors, message) {
					console.log(xhr, errors, message);
				},
				beforeSend: function() {
					navigasi.process("load");
				},
				success: function(data) {
					if(!$.trim(data)) {
						notification.open("danger", "Menu "+ desc +" sudah ada di Favorite.", 2000);
					} else {
					$(".navbar-favoritebody").html(data);
						notification.open("success", "Menu "+ desc +" berhasil ditambah ke Favorite.", 2000);
					}
				},
				complete: function() {
					navigasi.process("destroy");
					_this.find("a").removeAttr("data-href");
				}
			});
		}
	});
	// 6). event copy link address
	$("body").off("click","#copylink_address").on("click","#copylink_address", function(e) {
		e.preventDefault();
		var _this=$(this),
			_temp = $("<input>");

		// append to body
		$("body").append(_temp);
		_temp.val(location.host + _this.attr("data-copy")).select();
		document.execCommand("copy");
		// langsung di remove setelah execCommand = true
		_temp.remove();
	});
	/** end event selectable menu to favorite menu  */

	/** resizable menu container */
	// handles { n: top center, e: right center, s: bottom center, w: left center }
	// handles { ne: top right, se: bottom right, sw: bottom left, nw: top left }
	$(".navbar-favorite-container").resizable({
		handles: "n",
		minHeight: 220,
		maxHeight: 430,
		create: function(ev, ui) {
			$(".ui-resizable-handle.ui-resizable-n").append("<span>==</span>");
		},
		resize: function(ev, ui) {
			var _currentHeight = ui.size.height,
				_this=$(this);
			_this.height(_currentHeight);
		},
		stop: function(ev, ui) {
			var _currentTop = parseInt($(".navbar-favorite-container").css("top")),
				_currentNavbarMenuHeight = $(".navbar-menu-container").outerHeight() + _currentTop,
				_currentNavbarMenuBodyHeight = $(".navbar-menubody").outerHeight() + _currentTop,
				_this=$(this);

			_this.css({top:0});
			$(".navbar-menu-container").css({height:_currentNavbarMenuHeight});
			$(".navbar-menubody").css({height:_currentNavbarMenuBodyHeight});
			// save position height
			$.ajax({
				url: location.pathname+"?r=favorite/position",
				type: "POST",
				dataType: "text",
				data: {
					"Favorite[menu_size]": ui.size.height+'~'+_currentNavbarMenuHeight+'~'+_currentNavbarMenuBodyHeight,
					"Favorite[data_type]": "size",
				},
				beforeSend: function() {},
				success: function(data) {},
				complete: function() {},
				error: function(xhr, errors, message) {
					console.log(xhr, errors, message);
				},
			});
		}
	});
	// resize right navbar left
	$(".navbar-left").resizable({
		handles: "e",
		minWidth: 250,
		maxWidth: 450,
	});
	/** end resizable menu container */

	/** event helper notification */
	// open helper notification
	$("body").off("click","a[data-help]").on("click","a[data-help]", function(e) {
		e.preventDefault();
		$(".helper-notification").removeClass("bounceOutRight").removeClass("hidden");
	});
	// close helper notification
	$("body").off("click","a[data-close]").on("click","a[data-close]", function(e) {
		e.preventDefault();
		$(".helper-notification").addClass("bounceOutRight");
	});
	/** end event click open helper notification */

	/** event force uppercase text */
	$("body").off("keyup","input[type=\"text\"]:not([data-search]):not([data-plugin-inputmask]):not([not-uppercase]), textarea:not([not-uppercase])");
	$("body").on("keyup","input[type=\"text\"]:not([data-search]):not([data-plugin-inputmask]):not([not-uppercase]), textarea:not([not-uppercase])", function(e) {
		e.preventDefault();
		if($(this).parents(".filters").length > 0) {
			$(this).val($(this).val().toLowerCase());
		} else {
			$(this).val($(this).val().toUpperCase());
		}
	});
	/** end event force uppercase text */

	/** event open readmore */
	$("body").off("click","[data-show]").on("click","[data-show]", function(e){
		e.preventDefault();
		var $toggleClass = $(this).prev();
		if($toggleClass.hasClass("show-text")){
			$toggleClass.removeClass("show-text");
		} else{
			$toggleClass.removeClass("show-text").addClass("show-text");
		}
	});
	/** end event open readmore */

	/** event before submit */
	$(document).off("beforeSubmit", "form:not(#login-form):not([data-form=\"x_form\"])").on("beforeSubmit", "form:not(#login-form):not([data-form=\"x_form\"])", function(e){
		loading.open("loading bars");
	});
	/** end event before submit */
});
