$(".js-select-menu").on("click", function() {
    var $menu = $(this);
    var $menuState = $menu.find(".js-menu-state");
    if ($menuState.is(":checked")) {
        $(document).one("mouseup", function(e) {
            if (!$menu.is(e.target) &&
                $menu.has(e.target).length === 0) {
                $menuState.prop("checked", "");
            }
        });
    }
});

$(".js-option").on("change", function() {
    var $optionMenu = $(this).closest(".js-select-options");
    var $checkedList = $optionMenu.find(".js-option:checked ~ span");
    var $label = $optionMenu.prev(".js-select-label");

    if (!$(".js-check-all").is(":checked") &&
        $checkedList.length === $(".js-option").length) {
        $(".js-check-all").prop("checked", true);
    }

    if ($(".js-check-all").is(":checked") &&
        $checkedList.length !== $(".js-option").length) {
        $(".js-check-all").prop("checked", false);
    }

    if (!$checkedList.length) {
        $label.attr("data-label", $label.data("defaultLabel"))
        return;
    }

    var text = "";
    $checkedList.each(function(index) {
        text += $(this).text();
        if (index + 1 !== $checkedList.length) {
            text += ", "
        }
    });

    $label.attr("data-label", text)
});

$(".js-check-all").on("change", function() {
    var $toggle = $(this);
    var checked = $toggle.is(":checked") ? true : false;

    $toggle.closest(".js-select-options").find(".js-option").each(function() {
        $(this).prop("checked", checked).change();
    });
});

$.fn.selectMenuValue = function() {
    var $checked = this.find('.js-select-options .js-option:checked');
    if ($checked.length) {
        return [];
    }

    var valueArray = [];
    $checked.each(function() {
        valueArray.push($(this).val());
    });

    return valueArray;
}


// filter js
$(".js-filter-input").on("keyup", function() {
    var userSuppliedCriteria = $.trim($(this).val()).toLowerCase().split(" ");
    $(".js-filterable").each(function() {
        var $filterableElement = $(this);
        if ($filterableElement.shouldBeExcluded(userSuppliedCriteria)) {
            $filterableElement.hide();
        } else {
            $filterableElement.show();
        }
    });
});

$.fn.shouldBeExcluded = function(userSuppliedCriteria) {
    var elementCriteria = this.data("filterCriteria").toLowerCase();
    return userSuppliedCriteria.some(function(word) {
        return elementCriteria.indexOf(word) === -1;
    });
};