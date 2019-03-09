function setutcClock() {
    var currentTime = new Date();
    var month = ["JAN", "FEB", "MAR", "ARP", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"];
    var timeString = ("0" + currentTime.getUTCHours()).slice(-2);
    timeString = timeString + ":";
    timeString = timeString + ("0" + currentTime.getUTCMinutes()).slice(-2);
    timeString = timeString + " UTC ";
    $("#newtimeTM").html(timeString);
}


$(document).ready(function () {

    window.setInterval(setutcClock, 1000);

    // /* Notification Tab Intialization code Begins Here */
    // $('#notifylist').easyResponsiveTabs({
    //     type: 'default', //Types: default, vertical, accordion
    //     width: 'auto', //auto or any width like 600px
    //     fit: true, // 100% fit in a container
    //     tabidentify: 'hor_1', // The tab groups identifier
    //     activate: function (event) { // Callback function if tab is switched
    //         var $tab = $(this);
    //         var $info = $('#nested-tabInfo');
    //         var $name = $('span', $info);
    //         $name.text($tab.text());
    //         $info.show();
    //     }
    // });



    /* Notification Tab Intialization code Ends Here */


    /* new notification tab initialization strats here */
    $(".notification-block .notfications").click(function () {
        $(".notif-content-block").fadeIn();
        $(".notify-bg").fadeIn();
    });
    $(".notify-bg").click(function () {
        $(".notif-content-block").fadeOut();
        $(".notify-bg").fadeOut();
    });
    $("body").click(function () {
        // var bodyheight = $(this).height();
        //var notifht = $(".notify-bg").css({"height","900px"});
        var bdHeight = $('body').height();
        $('.notify-bg').css('height', +bdHeight + 'px');
    });
    /* new notification tab initialization strats here */



    $(".dropdown dt a").click(function () {
        $(".dropdown dd ul").toggle();
    });

    $(".dropdown dd ul li a").click(function () {
        var text = $(this).html();
        $(".dropdown dt a span").html(text);
        $(".dropdown dd ul").hide();

    });

    function getSelectedValue(id) {
        return $("#" + id).find("dt a span.value").html();
    }

    $(document).bind('click', function (e) {
        var $clicked = $(e.target);
        if (!$clicked.parents().hasClass("dropdown"))
            $(".dropdown dd ul").hide();
    });


    $(".dropdowns dt a").click(function () {
        $(".dropdowns dd ul").toggle();
    });

    $(".dropdowns dd ul li a").click(function () {
        var text = $(this).html();
        $(".dropdowns dt a span").html(text);
        $(".dropdowns dd ul").hide();

    });

    function getSelectedValue(id) {
        return $("#" + id).find("dt a span.value").html();
    }

    $(document).bind('click', function (e) {
        var $clicked = $(e.target);
        if (!$clicked.parents().hasClass("dropdowns"))
            $(".dropdowns dd ul").hide();
    });

    $(".speed dt a").click(function () {
        $(".speed dd ul").toggle();
    });

    $(".speed dd ul li a").click(function () {
        var text = $(this).html();
        $(".speed dt a span").html(text);
        $(".speed dd ul").hide();

    });

    function getSelectedValue(id) {
        return $("#" + id).find("dt a span.value").html();
    }

    $(document).bind('click', function (e) {
        var $clicked = $(e.target);
        if (!$clicked.parents().hasClass("speed"))
            $(".speed dd ul").hide();
    });

    $(".level dt a").click(function () {
        $(".level dd ul").toggle();
    });

    $(".level dd ul li a").click(function () {
        var text = $(this).html();
        $(".level dt a span").html(text);
        $(".level dd ul").hide();

    });

    function getSelectedValue(id) {
        return $("#" + id).find("dt a span.value").html();
    }

    $(document).bind('click', function (e) {
        var $clicked = $(e.target);
        if (!$clicked.parents().hasClass("level"))
            $(".level dd ul").hide();
    });

    $(".modhrs dt a").click(function () {
        $(".modhrs dd ul").toggle();
    });

    $(".modhrs dd ul li a").click(function () {
        var text = $(this).html();
        $(".modhrs dt a span").html(text);
        $(".modhrs dd ul").hide();

    });

    function getSelectedValue(id) {
        return $("#" + id).find("dt a span.value").html();
    }

    $(document).bind('click', function (e) {
        var $clicked = $(e.target);
        if (!$clicked.parents().hasClass("modhrs"))
            $(".modhrs dd ul").hide();
    });

    $(".modmin dt a").click(function () {
        $(".modmin dd ul").toggle();
    });

    $(".modmin dd ul li a").click(function () {
        var text = $(this).html();
        $(".modmin dt a span").html(text);
        $(".modmin dd ul").hide();

    });

    function getSelectedValue(id) {
        return $("#" + id).find("dt a span.value").html();
    }

    $(document).bind('click', function (e) {
        var $clicked = $(e.target);
        if (!$clicked.parents().hasClass("modmin"))
            $(".modmin dd ul").hide();
    });


    $(".nationality dt a").click(function () {
        $(".nationality dd ul").toggle();
    });

    $(".nationality dd ul li a").click(function () {
        var text = $(this).html();
        $(".nationality dt a span").html(text);
        $(".nationality dd ul").hide();

    });

    function getSelectedValue(id) {
        return $("#" + id).find("dt a span.value").html();
    }

    $(document).bind('click', function (e) {
        var $clicked = $(e.target);
        if (!$clicked.parents().hasClass("nationality"))
            $(".nationality dd ul").hide();
    });

    $(".endhrs dt a").click(function () {
        $(".endhrs dd ul").toggle();
    });

    $(".endhrs dd ul li a").click(function () {
        var text = $(this).html();
        $(".endhrs dt a span").html(text);
        $(".endhrs dd ul").hide();

    });

    function getSelectedValue(id) {
        return $("#" + id).find("dt a span.value").html();
    }

    $(document).bind('click', function (e) {
        var $clicked = $(e.target);
        if (!$clicked.parents().hasClass("endhrs"))
            $(".endhrs dd ul").hide();
    });

    $(".endmin dt a").click(function () {
        $(".endmin dd ul").toggle();
    });

    $(".endmin dd ul li a").click(function () {
        var text = $(this).html();
        $(".endmin dt a span").html(text);
        $(".endmin dd ul").hide();

    });

    function getSelectedValue(id) {
        return $("#" + id).find("dt a span.value").html();
    }

    $(document).bind('click', function (e) {
        var $clicked = $(e.target);
        if (!$clicked.parents().hasClass("endmin"))
            $(".endmin dd ul").hide();
    });


    $(".flrules dt a").click(function () {
        $(".flrules dd ul").toggle();
    });

    $(".flrules dd ul li a").click(function () {
        var text = $(this).html();
        $(".flrules dt a span").html(text);
        $(".flrules dd ul").hide();

    });

    function getSelectedValue(id) {
        return $("#" + id).find("dt a span.value").html();
    }

    $(document).bind('click', function (e) {
        var $clicked = $(e.target);
        if (!$clicked.parents().hasClass("flrules"))
            $(".flrules dd ul").hide();
    });



    $(".fltypes dt a").click(function () {
        $(".fltypes dd ul").toggle();
    });

    $(".fltypes dd ul li a").click(function () {
        var text = $(this).html();
        $(".fltypes dt a span").html(text);
        $(".fltypes dd ul").hide();

    });

    function getSelectedValue(id) {
        return $("#" + id).find("dt a span.value").html();
    }

    $(document).bind('click', function (e) {
        var $clicked = $(e.target);
        if (!$clicked.parents().hasClass("fltypes"))
            $(".fltypes dd ul").hide();
    });


    $(".wtcat dt a").click(function () {
        $(".wtcat dd ul").toggle();
    });

    $(".wtcat dd ul li a").click(function () {
        var text = $(this).html();
        $(".wtcat dt a span").html(text);
        $(".wtcat dd ul").hide();

    });

    function getSelectedValue(id) {
        return $("#" + id).find("dt a span.value").html();
    }

    $(document).bind('click', function (e) {
        var $clicked = $(e.target);
        if (!$clicked.parents().hasClass("wtcat"))
            $(".wtcat dd ul").hide();
    });


    $(".transmode dt a").click(function () {
        $(".transmode dd ul").toggle();
    });

    $(".transmode dd ul li a").click(function () {
        var text = $(this).html();
        $(".transmode dt a span").html(text);
        $(".transmode dd ul").hide();

    });

    function getSelectedValue(id) {
        return $("#" + id).find("dt a span.value").html();
    }

    $(document).bind('click', function (e) {
        var $clicked = $(e.target);
        if (!$clicked.parents().hasClass("transmode"))
            $(".transmode dd ul").hide();
    });

    $(".tt-hrs dt a").click(function () {
        $(".tt-hrs dd ul").toggle();
    });

    $(".tt-hrs dd ul li a").click(function () {
        var text = $(this).html();
        $(".tt-hrs dt a span").html(text);
        $(".tt-hrs dd ul").hide();

    });

    function getSelectedValue(id) {
        return $("#" + id).find("dt a span.value").html();
    }

    $(document).bind('click', function (e) {
        var $clicked = $(e.target);
        if (!$clicked.parents().hasClass("tt-hrs"))
            $(".tt-hrs dd ul").hide();
    });

    $(".tt-mins dt a").click(function () {
        $(".tt-mins dd ul").toggle();
    });

    $(".tt-mins dd ul li a").click(function () {
        var text = $(this).html();
        $(".tt-mins dt a span").html(text);
        $(".tt-mins dd ul").hide();

    });

    function getSelectedValue(id) {
        return $("#" + id).find("dt a span.value").html();
    }

    $(document).bind('click', function (e) {
        var $clicked = $(e.target);
        if (!$clicked.parents().hasClass("crfacility"))
            $(".crfacility dd ul").hide();
    });

    $(".crfacility dt a").click(function () {
        $(".crfacility dd ul").toggle();
    });

    $(".crfacility dd ul li a").click(function () {
        var text = $(this).html();
        $(".crfacility dt a span").html(text);
        $(".crfacility dd ul").hide();

    });

    function getSelectedValue(id) {
        return $("#" + id).find("dt a span.value").html();
    }

    $(document).bind('click', function (e) {
        var $clicked = $(e.target);
        if (!$clicked.parents().hasClass("crfacility"))
            $(".crfacility dd ul").hide();
    });





});



(function () { // BeginSpryComponent

    if (typeof Spry == "undefined")
        window.Spry = {};
    if (!Spry.Widget)
        Spry.Widget = {};

    Spry.Widget.TabbedPanels = function (element, opts)
    {
        this.element = this.getElement(element);
        this.defaultTab = 0; // Show the first panel by default.
        this.tabSelectedClass = "TabbedPanelsTabSelected";
        this.tabHoverClass = "TabbedPanelsTabHover";
        this.tabFocusedClass = "TabbedPanelsTabFocused";
        this.panelVisibleClass = "TabbedPanelsContentVisible";
        this.focusElement = null;
        this.hasFocus = false;
        this.currentTabIndex = 0;
        this.enableKeyboardNavigation = true;
        this.nextPanelKeyCode = Spry.Widget.TabbedPanels.KEY_RIGHT;
        this.previousPanelKeyCode = Spry.Widget.TabbedPanels.KEY_LEFT;

        Spry.Widget.TabbedPanels.setOptions(this, opts);

        // If the defaultTab is expressed as a number/index, convert
        // it to an element.

        if (typeof (this.defaultTab) == "number")
        {
            if (this.defaultTab < 0)
                this.defaultTab = 0;
            else
            {
                var count = this.getTabbedPanelCount();
                if (this.defaultTab >= count)
                    this.defaultTab = (count > 1) ? (count - 1) : 0;
            }

            this.defaultTab = this.getTabs()[this.defaultTab];
        }

        // The defaultTab property is supposed to be the tab element for the tab content
        // to show by default. The caller is allowed to pass in the element itself or the
        // element's id, so we need to convert the current value to an element if necessary.

        if (this.defaultTab)
            this.defaultTab = this.getElement(this.defaultTab);

        this.attachBehaviors();
    };

    Spry.Widget.TabbedPanels.prototype.getElement = function (ele)
    {
        if (ele && typeof ele == "string")
            return document.getElementById(ele);
        return ele;
    };

    Spry.Widget.TabbedPanels.prototype.getElementChildren = function (element)
    {
        var children = [];
        var child = element.firstChild;
        while (child)
        {
            if (child.nodeType == 1 /* Node.ELEMENT_NODE */)
                children.push(child);
            child = child.nextSibling;
        }
        return children;
    };

    Spry.Widget.TabbedPanels.prototype.addClassName = function (ele, className)
    {
        if (!ele || !className || (ele.className && ele.className.search(new RegExp("\\b" + className + "\\b")) != -1))
            return;
        ele.className += (ele.className ? " " : "") + className;
    };

    Spry.Widget.TabbedPanels.prototype.removeClassName = function (ele, className)
    {
        if (!ele || !className || (ele.className && ele.className.search(new RegExp("\\b" + className + "\\b")) == -1))
            return;
        ele.className = ele.className.replace(new RegExp("\\s*\\b" + className + "\\b", "g"), "");
    };

    Spry.Widget.TabbedPanels.setOptions = function (obj, optionsObj, ignoreUndefinedProps)
    {
        if (!optionsObj)
            return;
        for (var optionName in optionsObj)
        {
            if (ignoreUndefinedProps && optionsObj[optionName] == undefined)
                continue;
            obj[optionName] = optionsObj[optionName];
        }
    };

    Spry.Widget.TabbedPanels.prototype.getTabGroup = function ()
    {
        if (this.element)
        {
            var children = this.getElementChildren(this.element);
            if (children.length)
                return children[0];
        }
        return null;
    };

    Spry.Widget.TabbedPanels.prototype.getTabs = function ()
    {
        var tabs = [];
        var tg = this.getTabGroup();
        if (tg)
            tabs = this.getElementChildren(tg);
        return tabs;
    };

    Spry.Widget.TabbedPanels.prototype.getContentPanelGroup = function ()
    {
        if (this.element)
        {
            var children = this.getElementChildren(this.element);
            if (children.length > 1)
                return children[1];
        }
        return null;
    };

    Spry.Widget.TabbedPanels.prototype.getContentPanels = function ()
    {
        var panels = [];
        var pg = this.getContentPanelGroup();
        if (pg)
            panels = this.getElementChildren(pg);
        return panels;
    };

    Spry.Widget.TabbedPanels.prototype.getIndex = function (ele, arr)
    {
        ele = this.getElement(ele);
        if (ele && arr && arr.length)
        {
            for (var i = 0; i < arr.length; i++)
            {
                if (ele == arr[i])
                    return i;
            }
        }
        return -1;
    };

    Spry.Widget.TabbedPanels.prototype.getTabIndex = function (ele)
    {
        var i = this.getIndex(ele, this.getTabs());
        if (i < 0)
            i = this.getIndex(ele, this.getContentPanels());
        return i;
    };

    Spry.Widget.TabbedPanels.prototype.getCurrentTabIndex = function ()
    {
        return this.currentTabIndex;
    };

    Spry.Widget.TabbedPanels.prototype.getTabbedPanelCount = function (ele)
    {
        return Math.min(this.getTabs().length, this.getContentPanels().length);
    };

    Spry.Widget.TabbedPanels.addEventListener = function (element, eventType, handler, capture)
    {
        try
        {
            if (element.addEventListener)
                element.addEventListener(eventType, handler, capture);
            else if (element.attachEvent)
                element.attachEvent("on" + eventType, handler);
        } catch (e) {
        }
    };

    Spry.Widget.TabbedPanels.prototype.cancelEvent = function (e)
    {
        if (e.preventDefault)
            e.preventDefault();
        else
            e.returnValue = false;
        if (e.stopPropagation)
            e.stopPropagation();
        else
            e.cancelBubble = true;

        return false;
    };

    Spry.Widget.TabbedPanels.prototype.onTabClick = function (e, tab)
    {
        this.showPanel(tab);
        return this.cancelEvent(e);
    };

    Spry.Widget.TabbedPanels.prototype.onTabMouseOver = function (e, tab)
    {
        this.addClassName(tab, this.tabHoverClass);
        return false;
    };

    Spry.Widget.TabbedPanels.prototype.onTabMouseOut = function (e, tab)
    {
        this.removeClassName(tab, this.tabHoverClass);
        return false;
    };

    Spry.Widget.TabbedPanels.prototype.onTabFocus = function (e, tab)
    {
        this.hasFocus = true;
        this.addClassName(tab, this.tabFocusedClass);
        return false;
    };

    Spry.Widget.TabbedPanels.prototype.onTabBlur = function (e, tab)
    {
        this.hasFocus = false;
        this.removeClassName(tab, this.tabFocusedClass);
        return false;
    };

    Spry.Widget.TabbedPanels.KEY_UP = 38;
    Spry.Widget.TabbedPanels.KEY_DOWN = 40;
    Spry.Widget.TabbedPanels.KEY_LEFT = 37;
    Spry.Widget.TabbedPanels.KEY_RIGHT = 39;



    Spry.Widget.TabbedPanels.prototype.onTabKeyDown = function (e, tab)
    {
        var key = e.keyCode;
        if (!this.hasFocus || (key != this.previousPanelKeyCode && key != this.nextPanelKeyCode))
            return true;

        var tabs = this.getTabs();
        for (var i = 0; i < tabs.length; i++)
            if (tabs[i] == tab)
            {
                var el = false;
                if (key == this.previousPanelKeyCode && i > 0)
                    el = tabs[i - 1];
                else if (key == this.nextPanelKeyCode && i < tabs.length - 1)
                    el = tabs[i + 1];

                if (el)
                {
                    this.showPanel(el);
                    el.focus();
                    break;
                }
            }

        return this.cancelEvent(e);
    };

    Spry.Widget.TabbedPanels.prototype.preorderTraversal = function (root, func)
    {
        var stopTraversal = false;
        if (root)
        {
            stopTraversal = func(root);
            if (root.hasChildNodes())
            {
                var child = root.firstChild;
                while (!stopTraversal && child)
                {
                    stopTraversal = this.preorderTraversal(child, func);
                    try {
                        child = child.nextSibling;
                    } catch (e) {
                        child = null;
                    }
                }
            }
        }
        return stopTraversal;
    };

    Spry.Widget.TabbedPanels.prototype.addPanelEventListeners = function (tab, panel)
    {
        var self = this;
        Spry.Widget.TabbedPanels.addEventListener(tab, "click", function (e) {
            return self.onTabClick(e, tab);
        }, false);
        Spry.Widget.TabbedPanels.addEventListener(tab, "mouseover", function (e) {
            return self.onTabMouseOver(e, tab);
        }, false);
        Spry.Widget.TabbedPanels.addEventListener(tab, "mouseout", function (e) {
            return self.onTabMouseOut(e, tab);
        }, false);

        if (this.enableKeyboardNavigation)
        {
            // XXX: IE doesn't allow the setting of tabindex dynamically. This means we can't
            // rely on adding the tabindex attribute if it is missing to enable keyboard navigation
            // by default.

            // Find the first element within the tab container that has a tabindex or the first
            // anchor tag.

            var tabIndexEle = null;
            var tabAnchorEle = null;

            this.preorderTraversal(tab, function (node) {
                if (node.nodeType == 1 /* NODE.ELEMENT_NODE */)
                {
                    var tabIndexAttr = tab.attributes.getNamedItem("tabindex");
                    if (tabIndexAttr)
                    {
                        tabIndexEle = node;
                        return true;
                    }
                    if (!tabAnchorEle && node.nodeName.toLowerCase() == "a")
                        tabAnchorEle = node;
                }
                return false;
            });

            if (tabIndexEle)
                this.focusElement = tabIndexEle;
            else if (tabAnchorEle)
                this.focusElement = tabAnchorEle;

            if (this.focusElement)
            {
                Spry.Widget.TabbedPanels.addEventListener(this.focusElement, "focus", function (e) {
                    return self.onTabFocus(e, tab);
                }, false);
                Spry.Widget.TabbedPanels.addEventListener(this.focusElement, "blur", function (e) {
                    return self.onTabBlur(e, tab);
                }, false);
                Spry.Widget.TabbedPanels.addEventListener(this.focusElement, "keydown", function (e) {
                    return self.onTabKeyDown(e, tab);
                }, false);
            }
        }
    };

    Spry.Widget.TabbedPanels.prototype.showPanel = function (elementOrIndex)
    {
        var tpIndex = -1;

        if (typeof elementOrIndex == "number")
            tpIndex = elementOrIndex;
        else // Must be the element for the tab or content panel.
            tpIndex = this.getTabIndex(elementOrIndex);

        if (!tpIndex < 0 || tpIndex >= this.getTabbedPanelCount())
            return;

        var tabs = this.getTabs();
        var panels = this.getContentPanels();

        var numTabbedPanels = Math.max(tabs.length, panels.length);

        for (var i = 0; i < numTabbedPanels; i++)
        {
            if (i != tpIndex)
            {
                if (tabs[i])
                    this.removeClassName(tabs[i], this.tabSelectedClass);
                if (panels[i])
                {
                    this.removeClassName(panels[i], this.panelVisibleClass);
                    panels[i].style.display = "none";
                }
            }
        }

        this.addClassName(tabs[tpIndex], this.tabSelectedClass);
        this.addClassName(panels[tpIndex], this.panelVisibleClass);
        panels[tpIndex].style.display = "block";

        this.currentTabIndex = tpIndex;
    };

    Spry.Widget.TabbedPanels.prototype.attachBehaviors = function (element)
    {
        var tabs = this.getTabs();
        var panels = this.getContentPanels();
        var panelCount = this.getTabbedPanelCount();

        for (var i = 0; i < panelCount; i++)
            this.addPanelEventListeners(tabs[i], panels[i]);

        this.showPanel(this.defaultTab);
    };

})(); // EndSpryComponent
