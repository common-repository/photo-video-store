/*
 * Async Treeview 0.1 - Lazy-loading extension for Treeview
 *
 * http://bassistance.de/jquery-plugins/jquery-plugin-treeview/
 *
 * Copyright Jörn Zaefferer
 * Released under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 */

;(function($) {

function load(settings, root, child, container) {
	function createNode(parent) {
		var current = jQuery("<li/>").attr("id", this.id || "").html("<span>" + this.text + "</span>").appendTo(parent);
		if (this.classes) {
			current.children("span").addClass(this.classes);
		}
		if (this.expanded) {
			current.addClass("open");
		}
		if (this.hasChildren || this.children && this.children.length) {
			var branch = jQuery("<ul/>").appendTo(current);
			if (this.hasChildren) {
				current.addClass("hasChildren");
				createNode.call({
					classes: "placeholder",
					text: "&nbsp;",
					children:[]
				}, branch);
			}
			if (this.children && this.children.length) {
				jQuery.each(this.children, createNode, [branch])
			}
		}
	}
	jQuery.ajax(jQuery.extend(true, {
		url: settings.url,
		dataType: "json",
		data: {
			root: root
		},
		success: function(response) {
			child.empty();
			jQuery.each(response, createNode, [child]);
	        jQuery(container).treeview({add: child});
	    }
	}, settings.ajax));
	/*
	jQuery.getJSON(settings.url, {root: root}, function(response) {
		function createNode(parent) {
			var current = jQuery("<li/>").attr("id", this.id || "").html("<span>" + this.text + "</span>").appendTo(parent);
			if (this.classes) {
				current.children("span").addClass(this.classes);
			}
			if (this.expanded) {
				current.addClass("open");
			}
			if (this.hasChildren || this.children && this.children.length) {
				var branch = jQuery("<ul/>").appendTo(current);
				if (this.hasChildren) {
					current.addClass("hasChildren");
					createNode.call({
						classes: "placeholder",
						text: "&nbsp;",
						children:[]
					}, branch);
				}
				if (this.children && this.children.length) {
					jQuery.each(this.children, createNode, [branch])
				}
			}
		}
		child.empty();
		jQuery.each(response, createNode, [child]);
        jQuery(container).treeview({add: child});
    });
    */
}

var proxied = jQuery.fn.treeview;
jQuery.fn.treeview = function(settings) {
	if (!settings.url) {
		return proxied.apply(this, arguments);
	}
	if (!settings.root) {
		settings.root = "source";
	}
	var container = this;
	if (!container.children().size())
		load(settings, settings.root, this, container);
	var userToggle = settings.toggle;
	return proxied.call(this, jQuery.extend({}, settings, {
		collapsed: true,
		toggle: function() {
			var $this = jQuery(this);
			if ($this.hasClass("hasChildren")) {
				var childList = $this.removeClass("hasChildren").find("ul");
				load(settings, this.id, childList, container);
			}
			if (userToggle) {
				userToggle.apply(this, arguments);
			}
		}
	}));
};

})(jQuery);
