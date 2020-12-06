"use strict";

var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; };

// Attach Parent Selector
var commons = function () {
	
	function commons() {}
	commons.attachParentSelector = function (parentSelector, defaultSelector) {
		var customSelector = defaultSelector;
		if (parentSelector !== '' && parentSelector.length > 0) {
			if (parentSelector === defaultSelector) {
				customSelector = defaultSelector;
			} else if ($(parentSelector).hasClass(defaultSelector)) {
				customSelector = parentSelector + "" + defaultSelector;
			} else {
				customSelector = parentSelector + " " + defaultSelector;
			}
		}
		return customSelector;
	};
	return commons;
};

// Inherit one class to another
function _inherits(SubClass, SuperClass) {
	if (typeof SuperClass !== "function" && SuperClass !== null) {
		throw new TypeError("Super expression must either be null or a function, not " + typeof SuperClass);
	}
	SubClass.prototype = new SuperClass();
}

// Propeller components Mapping
var propellerControlMapping = {
	"pmd-textfield": function () {
		$('.pmd-textfield').pmdTextfield();
	},
};






$( document ).ready(function() {

	//	$(".pmd-textfield .select2-selection").after('<span class="pmd-textfield-focused"></span>');
	
		var $eventSelect = $(".pmd-select2");
		$eventSelect.on("select2:opening", function () { 
			$(this).closest('.pmd-textfield').addClass("pmd-textfield-floating-label-active pmd-textfield-floating-label-completed");
		});
		
		$eventSelect.on("select2:close", function () {
			$(".pmd-textfield").removeClass("pmd-textfield-floating-label-active"); 
			var selected_value = $(this).val();
			   if (selected_value==0 || selected_value=='' || selected_value==undefined) {
				$(this).closest('.pmd-textfield').removeClass("pmd-textfield-floating-label-completed");
			   } else {
				$(this).closest('.pmd-textfield').addClass("pmd-textfield-floating-label-completed");
			}
		});
		$eventSelect.each(function(){
			var selected_value = $(this).val();
			   if (selected_value==0 || selected_value=='' || selected_value==undefined) {
				$(this).closest('.pmd-textfield').removeClass("pmd-textfield-floating-label-completed");
			   } else {
				$(this).closest('.pmd-textfield').addClass("pmd-textfield-floating-label-completed");
			}
		});
		
		var $eventSelectTag = $(".pmd-select2-tags");
		$eventSelectTag.on("select2:opening", function () { 
			$(this).closest('.pmd-textfield').addClass("pmd-textfield-floating-label-active pmd-textfield-floating-label-completed");
		});
		
		$eventSelectTag.on("select2:close", function () {
			$(".pmd-textfield").removeClass("pmd-textfield-floating-label-active");
			var selected_tag = $(this).closest('.pmd-textfield').find('.select2-selection__choice').hasClass('select2-selection__choice');
			if (selected_tag) {
				$(this).closest('.pmd-textfield').addClass("pmd-textfield-floating-label-completed");
			} else {
				$(this).closest('.pmd-textfield').removeClass("pmd-textfield-floating-label-completed");
			}
		});
		
		$eventSelectTag.on("change", function(){
			if ($('.select2-selection__rendered li').hasClass('select2-selection__choice')) {
				$(this).closest('.pmd-textfield').addClass("pmd-textfield-floating-label-completed");
			} else {
				$(this).closest('.pmd-textfield').removeClass("pmd-textfield-floating-label-completed");
			}
		});
		
		$eventSelectTag.each(function(){
			var selected_tag = $(this).find('option').attr('selected')
			if (selected_tag) {
				$(this).closest('.pmd-textfield').addClass("pmd-textfield-floating-label-completed");
			} else {
				$(this).closest('.pmd-textfield').removeClass("pmd-textfield-floating-label-completed");
			}
		});
		
	});






















var pmdTextfield = function ($) {		
	
	
   /**
	* ------------------------------------------------------------------------
	* Variables
	* ------------------------------------------------------------------------
	*/

	var NAME = 'pmdTextfield';
	var JQUERY_NO_CONFLICT = $.fn[NAME];

	var ClassName = {
		PMD_TEXTFIELD: 'pmd-textfield',
		FOCUS: 'pmd-textfield-focused',
		FLOATING_COMPLETE: 'pmd-textfield-floating-label-completed',
		FLOATING_ACTIVE: 'pmd-textfield-floating-label-active'
	};

	var Selector = {
		PARENT_SELECTOR: '',
		PMD_TEXTFIELD: '.' + ClassName.PMD_TEXTFIELD,
		FOCUS: '.' + ClassName.FOCUS,
		INPUT: '.form-control'
	};

	var Template = {
		LABEL: '<span class="pmd-textfield-focused"></span>'
	};

	var Event = {
		FOCUS: 'focus',
		FOCUSOUT: 'focusout',
		CHANGE: 'change'
	};	

	/**
	* ------------------------------------------------------------------------
	* Functions
	* ------------------------------------------------------------------------
	*/

	function onFocus(e) {
		var $this = $(e.target);
		$this.closest(Selector.PMD_TEXTFIELD).addClass(ClassName.FLOATING_ACTIVE + " " + ClassName.FLOATING_COMPLETE);
	}

	function onFocusOut(e) {
		var $this = $(e.target);
		if ($this.val() === "") {
			$this.closest(Selector.PMD_TEXTFIELD).removeClass(ClassName.FLOATING_COMPLETE);
		}
		$this.closest(Selector.PMD_TEXTFIELD).removeClass(ClassName.FLOATING_ACTIVE);
	}

	function onChange(e) {
		var $this = $(e.target);
		if ($this.val() !== "") {
			$this.closest(Selector.PMD_TEXTFIELD).addClass(ClassName.FLOATING_COMPLETE);
		}
	}

	
   /**
	* ------------------------------------------------------------------------
	* Initialization
	* ------------------------------------------------------------------------
	*/

	var pmdTextfield = function () {
		_inherits(pmdTextfield, commons);
		function pmdTextfield() {
			$(pmdTextfield.prototype.attachParentSelector(Selector.PARENT_SELECTOR, Selector.FOCUS)).remove();
			$(pmdTextfield.prototype.attachParentSelector(Selector.PARENT_SELECTOR, Selector.PMD_TEXTFIELD)).find(Selector.INPUT).after(Template.LABEL);
			$(pmdTextfield.prototype.attachParentSelector(Selector.PARENT_SELECTOR, Selector.PMD_TEXTFIELD)).find(Selector.INPUT).each(function () {
				if ($(this).val() !== "") {
					$(this).closest(Selector.PMD_TEXTFIELD).addClass(ClassName.FLOATING_COMPLETE);
				}
			});
		}
		return pmdTextfield;
	}();

	
   /**
	* ------------------------------------------------------------------------
	* jQuery
	* ------------------------------------------------------------------------
	*/
	
	var plugInFunction = function () {
		if (this.selector !== "") {
		  Selector.PARENT_SELECTOR = this.selector;
		}
		new pmdTextfield();
	};
	$(document).on(Event.CHANGE, Selector.PMD_TEXTFIELD + " " + Selector.INPUT, onChange);
	$(document).on(Event.FOCUS, Selector.PMD_TEXTFIELD + " " + Selector.INPUT, onFocus);
	$(document).on(Event.FOCUSOUT, Selector.PMD_TEXTFIELD + " " + Selector.INPUT, onFocusOut);
	$.fn[NAME] = plugInFunction;
	return pmdTextfield;
  
} (jQuery)();
