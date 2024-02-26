<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamento de Serviços | AgendOS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome-font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/css/datepicker.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <style>
        /*!
 * FullCalendar v3.9.0
 * Docs & License: https://fullcalendar.io/
 * (c) 2018 Adam Shaw
 */
        .fc {
            direction: ltr;
            text-align: left;
        }

        .fc-rtl {
            text-align: right;
        }

        body .fc {
            /* extra precedence to overcome jqui */
            font-size: 1em;
        }

        /* Colors
--------------------------------------------------------------------------------------------------*/
        .fc-highlight {
            /* when user is selecting cells */
            background: #bce8f1;
            opacity: .3;
        }

        .fc-bgevent {
            /* default look for background events */
            background: #8fdf82;
            opacity: .3;
        }

        .fc-nonbusiness {
            /* default look for non-business-hours areas */
            /* will inherit .fc-bgevent's styles */
            background: rgba(52, 40, 104, .05);
        }

        /* Buttons (styled <button> tags, normalized to work cross-browser)
--------------------------------------------------------------------------------------------------*/
        .fc button {
            /* force height to include the border and padding */
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            /* dimensions */
            margin: 0;
            height: auto;
            padding: 0 .6em;
            /* text & cursor */
            font-size: 1em;
            /* normalize */
            white-space: nowrap;
            cursor: pointer;
        }

        /* Firefox has an annoying inner border */
        .fc button::-moz-focus-inner {
            margin: 0;
            padding: 0;
        }

        .fc-state-default {
            /* non-theme */
            border: 1px solid;
        }

        .fc-state-default.fc-corner-left {
            /* non-theme */
            border-top-left-radius: 4px;
            border-bottom-left-radius: 4px;
        }

        .fc-state-default.fc-corner-right {
            /* non-theme */
            border-top-right-radius: 4px;
            border-bottom-right-radius: 4px;
        }

        /* icons in buttons */
        .fc button .fc-icon {
            /* non-theme */
            position: relative;
            top: -0.05em;
            /* seems to be a good adjustment across browsers */
            margin: 0 .2em;
            vertical-align: middle;
        }

        /*
  button states
  borrowed from twitter bootstrap (http://twitter.github.com/bootstrap/)
*/
        .fc-state-default {
            background-color: #f5f5f5;
            background-image: -moz-linear-gradient(top, #ffffff, #e6e6e6);
            background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#ffffff), to(#e6e6e6));
            background-image: -webkit-linear-gradient(top, #ffffff, #e6e6e6);
            background-image: -o-linear-gradient(top, #ffffff, #e6e6e6);
            background-image: linear-gradient(to bottom, #ffffff, #e6e6e6);
            background-repeat: repeat-x;
            border-color: #e6e6e6 #e6e6e6 #bfbfbf;
            border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
            color: #333;
            text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .fc-state-hover,
        .fc-state-down,
        .fc-state-active,
        .fc-state-disabled {
            color: #333333;
            background-color: #e6e6e6;
        }

        .fc-state-hover {
            color: #333333;
            text-decoration: none;
            background-position: 0 -15px;
            -webkit-transition: background-position 0.1s linear;
            -moz-transition: background-position 0.1s linear;
            -o-transition: background-position 0.1s linear;
            transition: background-position 0.1s linear;
        }

        .fc-state-down,
        .fc-state-active {
            background-color: #cccccc;
            background-image: none;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .fc-state-disabled {
            cursor: default;
            background-image: none;
            opacity: 0.65;
            box-shadow: none;
        }

        /* Buttons Groups
--------------------------------------------------------------------------------------------------*/
        .fc-button-group {
            display: inline-block;
        }

        /*
every button that is not first in a button group should scootch over one pixel and cover the
previous button's border...
*/
        .fc .fc-button-group>* {
            /* extra precedence b/c buttons have margin set to zero */
            float: left;
            margin: 0 0 0 -1px;
        }

        .fc .fc-button-group> :first-child {
            /* same */
            margin-left: 0;
        }

        /* Popover
--------------------------------------------------------------------------------------------------*/
        .fc-popover {
            position: absolute;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
        }

        .fc-popover .fc-header {
            /* TODO: be more consistent with fc-head/fc-body */
            padding: 2px 4px;
        }

        .fc-popover .fc-header .fc-title {
            margin: 0 2px;
        }

        .fc-popover .fc-header .fc-close {
            cursor: pointer;
        }

        .fc-ltr .fc-popover .fc-header .fc-title,
        .fc-rtl .fc-popover .fc-header .fc-close {
            float: left;
        }

        .fc-rtl .fc-popover .fc-header .fc-title,
        .fc-ltr .fc-popover .fc-header .fc-close {
            float: right;
        }

        /* Misc Reusable Components
--------------------------------------------------------------------------------------------------*/
        .fc-divider {
            border-style: solid;
            border-width: 1px;
        }

        hr.fc-divider {
            height: 0;
            margin: 0;
            padding: 0 0 2px;
            /* height is unreliable across browsers, so use padding */
            border-width: 1px 0;
        }

        .fc-clear {
            clear: both;
        }

        .fc-bg,
        .fc-bgevent-skeleton,
        .fc-highlight-skeleton,
        .fc-helper-skeleton {
            /* these element should always cling to top-left/right corners */
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
        }

        .fc-bg {
            bottom: 0;
            /* strech bg to bottom edge */
        }

        .fc-bg table {
            height: 100%;
            /* strech bg to bottom edge */
        }

        /* Tables
--------------------------------------------------------------------------------------------------*/
        .fc table {
            width: 100%;
            box-sizing: border-box;
            /* fix scrollbar issue in firefox */
            table-layout: fixed;
            border-collapse: collapse;
            border-spacing: 0;
            font-size: 1em;
            /* normalize cross-browser */
        }

        .fc th {
            text-align: center;
        }

        .fc th,
        .fc td {
            border-style: solid;
            border-width: 1px 1px 0 1px !important;
            padding: 0;
            border-color: #eee;
            vertical-align: top;
        }

        .fc td.fc-today {
            border-style: double;
            /* overcome neighboring borders */
        }

        /* Internal Nav Links
--------------------------------------------------------------------------------------------------*/
        a[data-goto] {
            cursor: pointer;
        }

        a[data-goto]:hover {
            text-decoration: underline;
        }

        /* Fake Table Rows
--------------------------------------------------------------------------------------------------*/
        .fc .fc-row {
            /* extra precedence to overcome themes w/ .ui-widget-content forcing a 1px border */
            /* no visible border by default. but make available if need be (scrollbar width compensation) */
            border-style: solid;
            border-width: 0;
        }

        .fc-row table {
            /* don't put left/right border on anything within a fake row.
     the outer tbody will worry about this */
            border-left: 0 hidden transparent;
            border-right: 0 hidden transparent;
            /* no bottom borders on rows */
            border-bottom: 0 hidden transparent;
        }

        .fc-row:first-child table {
            border-top: 0 hidden transparent;
            /* no top border on first row */
        }

        /* Day Row (used within the header and the DayGrid)
--------------------------------------------------------------------------------------------------*/
        .fc-row {
            position: relative;
            background: #ffffff;
        }

        .fc-row .fc-bg {
            z-index: 1;
        }

        /* highlighting cells & background event skeleton */
        .fc-row .fc-bgevent-skeleton,
        .fc-row .fc-highlight-skeleton {
            bottom: 0;
            /* stretch skeleton to bottom of row */
        }

        .fc-row .fc-bgevent-skeleton table,
        .fc-row .fc-highlight-skeleton table {
            height: 100%;
            /* stretch skeleton to bottom of row */
        }

        .fc-row .fc-highlight-skeleton td,
        .fc-row .fc-bgevent-skeleton td {
            border-color: transparent;
        }

        .fc-row .fc-bgevent-skeleton {
            z-index: 2;
        }

        .fc-row .fc-highlight-skeleton {
            z-index: 3;
        }

        /*
row content (which contains day/week numbers and events) as well as "helper" (which contains
temporary rendered events).
*/
        .fc-row .fc-content-skeleton {
            position: relative;
            z-index: 4;
            padding-bottom: 2px;
            /* matches the space above the events */
        }

        .fc-row .fc-helper-skeleton {
            z-index: 5;
        }

        .fc .fc-row .fc-content-skeleton table,
        .fc .fc-row .fc-content-skeleton td,
        .fc .fc-row .fc-helper-skeleton td {
            /* see-through to the background below */
            /* extra precedence to prevent theme-provided backgrounds */
            background: none;
            /* in case <td>s are globally styled */
            border-color: transparent;
            padding: .5rem .5rem;
        }

        .fc-row .fc-content-skeleton td,
        .fc-row .fc-helper-skeleton td {
            /* don't put a border between events and/or the day number */
            border-bottom: 0;
        }

        .fc-row .fc-content-skeleton tbody td,
        .fc-row .fc-helper-skeleton tbody td {
            /* don't put a border between event cells */
            border-top: 0;
        }

        /* Scrolling Container
--------------------------------------------------------------------------------------------------*/
        .fc-scroller {
            -webkit-overflow-scrolling: touch;
        }

        /* TODO: move to agenda/basic */
        .fc-scroller>.fc-day-grid,
        .fc-scroller>.fc-time-grid {
            position: relative;
            /* re-scope all positions */
            width: 100%;
            /* hack to force re-sizing this inner element when scrollbars appear/disappear */
        }

        /* Global Event Styles
--------------------------------------------------------------------------------------------------*/
        .fc-event {
            position: relative;
            /* for resize handle and other inner positioning */
            display: block;
            /* make the <a> tag block */
            font-size: 12px;
            line-height: 1.3;
            letter-spacing: 0.02em;
            border-radius: 3px;
            font-weight: 500;
            border: 1px solid #ddd;
            -webkit-box-shadow: 0px 1px 15px rgba(0, 0, 0, 0.05);
            -moz-box-shadow: 0px 1px 15px rgba(0, 0, 0, 0.05);
            box-shadow: 0px 1px 15px rgba(0, 0, 0, 0.05);
            /* default BORDER color */
        }

        .fc-event,
        .fc-event-dot {
            background-color: #ffffff;
            color: #5d5386;
            position: relative;
            /* default BACKGROUND color */
        }

        .fc-event:before,
        .fc-event-dot:before {
            content: "";
            position: absolute;
            left: 0;
            bottom: -2px;
            width: 50px;
            height: 100%;
            border-left: 3px solid #5d5386;
            border-bottom: 3px solid #5d5386;
            -webkit-border-radius: 3px 0px 0px 3px;
            -moz-border-radius: 3px 0px 0px 3px;
            border-radius: 3px 0px 0px 3px;
        }

        .fc-event .fc-title {
            font-weight: 500;
        }

        .fc-event i {
            font-size: 26px;
            margin-right: 8px;
            vertical-align: middle;
        }

        .fc-event,
        .fc-event:hover {
            color: #fff;
            /* default TEXT color */
            text-decoration: none;
            /* if <a> has an href */
        }

        .fc-event[href],
        .fc-event.fc-draggable {
            cursor: pointer;
            /* give events with links and draggable events a hand mouse pointer */
        }

        .fc-not-allowed,
        .fc-not-allowed .fc-event {
            /* to override an event's custom cursor */
            cursor: not-allowed;
        }

        .fc-event .fc-bg {
            /* the generic .fc-bg already does position */
            z-index: 1;
            background: #fff;
            opacity: .25;
        }

        .fc-event .fc-content {
            color: #2c304d;
            position: relative;
            z-index: 2;
            padding: 8px;
        }

        /* resizer (cursor AND touch devices) */
        .fc-event .fc-resizer {
            position: absolute;
            z-index: 4;
        }

        /* resizer (touch devices) */
        .fc-event .fc-resizer {
            display: none;
        }

        .fc-event.fc-allow-mouse-resize .fc-resizer,
        .fc-event.fc-selected .fc-resizer {
            /* only show when hovering or selected (with touch) */
            display: block;
        }

        /* hit area */
        .fc-event.fc-selected .fc-resizer:before {
            /* 40x40 touch area */
            content: "";
            position: absolute;
            z-index: 9999;
            /* user of this util can scope within a lower z-index */
            top: 50%;
            left: 50%;
            width: 40px;
            height: 40px;
            margin-left: -20px;
            margin-top: -20px;
        }

        /* Event Selection (only for touch devices)
--------------------------------------------------------------------------------------------------*/
        .fc-event.fc-selected {
            z-index: 9999 !important;
            /* overcomes inline z-index */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .fc-event.fc-selected.fc-dragging {
            box-shadow: 0 2px 7px rgba(0, 0, 0, 0.3);
        }

        /* Horizontal Events
--------------------------------------------------------------------------------------------------*/
        /* bigger touch area when selected */
        .fc-h-event.fc-selected:before {
            content: "";
            position: absolute;
            z-index: 3;
            /* below resizers */
            top: -10px;
            bottom: -10px;
            left: 0;
            right: 0;
        }

        /* events that are continuing to/from another week. kill rounded corners and butt up against edge */
        .fc-ltr .fc-h-event.fc-not-start,
        .fc-rtl .fc-h-event.fc-not-end {
            margin-left: 0;
            border-left-width: 0;
            padding-left: 1px;
            /* replace the border with padding */
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        .fc-ltr .fc-h-event.fc-not-end,
        .fc-rtl .fc-h-event.fc-not-start {
            margin-right: 0;
            border-right-width: 0;
            padding-right: 1px;
            /* replace the border with padding */
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        /* resizer (cursor AND touch devices) */
        /* left resizer  */
        .fc-ltr .fc-h-event .fc-start-resizer,
        .fc-rtl .fc-h-event .fc-end-resizer {
            cursor: w-resize;
            left: -1px;
            /* overcome border */
        }

        /* right resizer */
        .fc-ltr .fc-h-event .fc-end-resizer,
        .fc-rtl .fc-h-event .fc-start-resizer {
            cursor: e-resize;
            right: -1px;
            /* overcome border */
        }

        /* resizer (mouse devices) */
        .fc-h-event.fc-allow-mouse-resize .fc-resizer {
            width: 7px;
            top: -1px;
            /* overcome top border */
            bottom: -1px;
            /* overcome bottom border */
        }

        /* resizer (touch devices) */
        .fc-h-event.fc-selected .fc-resizer {
            /* 8x8 little dot */
            border-radius: 4px;
            border-width: 1px;
            width: 6px;
            height: 6px;
            border-style: solid;
            border-color: inherit;
            background: #fff;
            /* vertically center */
            top: 50%;
            margin-top: -4px;
        }

        /* left resizer  */
        .fc-ltr .fc-h-event.fc-selected .fc-start-resizer,
        .fc-rtl .fc-h-event.fc-selected .fc-end-resizer {
            margin-left: -4px;
            /* centers the 8x8 dot on the left edge */
        }

        /* right resizer */
        .fc-ltr .fc-h-event.fc-selected .fc-end-resizer,
        .fc-rtl .fc-h-event.fc-selected .fc-start-resizer {
            margin-right: -4px;
            /* centers the 8x8 dot on the right edge */
        }

        /* DayGrid events
----------------------------------------------------------------------------------------------------
We use the full "fc-day-grid-event" class instead of using descendants because the event won't
be a descendant of the grid when it is being dragged.
*/
        .fc-day-grid-event {
            margin: 1px 2px 0;
            /* spacing between events and edges */
            padding: 0;
        }

        tr:first-child>td>.fc-day-grid-event {
            margin-top: 2px;
            /* a little bit more space before the first event */
        }

        .fc-day-grid-event.fc-selected:after {
            content: "";
            position: absolute;
            z-index: 1;
            /* same z-index as fc-bg, behind text */
            /* overcome the borders */
            top: -1px;
            right: -1px;
            bottom: -1px;
            left: -1px;
            /* darkening effect */
            background: #000;
            opacity: .25;
        }

        .fc-day-grid-event .fc-content {
            /* force events to be one-line tall */
            white-space: nowrap;
            overflow: hidden;
        }

        .fc-day-grid-event .fc-time {
            font-weight: bold;
        }

        /* resizer (cursor devices) */
        /* left resizer  */
        .fc-ltr .fc-day-grid-event.fc-allow-mouse-resize .fc-start-resizer,
        .fc-rtl .fc-day-grid-event.fc-allow-mouse-resize .fc-end-resizer {
            margin-left: -2px;
            /* to the day cell's edge */
        }

        /* right resizer */
        .fc-ltr .fc-day-grid-event.fc-allow-mouse-resize .fc-end-resizer,
        .fc-rtl .fc-day-grid-event.fc-allow-mouse-resize .fc-start-resizer {
            margin-right: -2px;
            /* to the day cell's edge */
        }

        /* Event Limiting
--------------------------------------------------------------------------------------------------*/
        /* "more" link that represents hidden events */
        a.fc-more {
            margin: 1px 3px;
            font-size: .85em;
            cursor: pointer;
            text-decoration: none;
        }

        a.fc-more:hover {
            text-decoration: underline;
        }

        .fc-limited {
            /* rows and cells that are hidden because of a "more" link */
            display: none;
        }

        /* popover that appears when "more" link is clicked */
        .fc-day-grid .fc-row {
            z-index: 1;
            /* make the "more" popover one higher than this */
        }

        .fc-more-popover {
            z-index: 2;
            width: 220px;
        }

        .fc-more-popover .fc-event-container {
            padding: 10px;
        }

        /* Now Indicator
--------------------------------------------------------------------------------------------------*/
        .fc-now-indicator {
            position: absolute;
            border: 0 solid red;
        }

        /* Utilities
--------------------------------------------------------------------------------------------------*/
        .fc-unselectable {
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            -webkit-touch-callout: none;
            -webkit-tap-highlight-color: transparent;
        }

        /*
TODO: more distinction between this file and common.css
*/
        /* Colors
--------------------------------------------------------------------------------------------------*/
        .fc-unthemed th,
        .fc-unthemed td,
        .fc-unthemed thead,
        .fc-unthemed tbody,
        .fc-unthemed .fc-divider,
        .fc-unthemed .fc-row,
        .fc-unthemed .fc-content,
        .fc-unthemed .fc-popover,
        .fc-unthemed .fc-list-view,
        .fc-unthemed .fc-list-heading td {
            border-color: #ddd;
        }

        .fc-unthemed .fc-popover {
            background-color: #fff;
        }

        .fc-unthemed .fc-divider,
        .fc-unthemed .fc-popover .fc-header,
        .fc-unthemed .fc-list-heading td {
            background: #eee;
        }

        .fc-unthemed .fc-popover .fc-header .fc-close {
            color: #666;
        }

        .fc-unthemed td.fc-today {
            background: #fcf8e3;
        }

        .fc-unthemed .fc-disabled-day {
            background: #d7d7d7;
            opacity: .3;
        }

        /* Icons (inline elements with styled text that mock arrow icons)
--------------------------------------------------------------------------------------------------*/
        .fc-icon {
            display: inline-block;
            height: 1em;
            line-height: 1em;
            font-size: 1em;
            text-align: center;
            overflow: hidden;
            font-family: "Courier New", Courier, monospace;
            /* don't allow browser text-selection */
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /*
Acceptable font-family overrides for individual icons:
  "Arial", sans-serif
  "Times New Roman", serif

NOTE: use percentage font sizes or else old IE chokes
*/
        .fc-icon:after {
            position: relative;
        }

        .fc-icon-left-single-arrow:after {
            content: "\2039";
            font-weight: bold;
            font-size: 200%;
            top: -7%;
        }

        .fc-icon-right-single-arrow:after {
            content: "\203A";
            font-weight: bold;
            font-size: 200%;
            top: -7%;
        }

        .fc-icon-left-double-arrow:after {
            content: "\AB";
            font-size: 160%;
            top: -7%;
        }

        .fc-icon-right-double-arrow:after {
            content: "\BB";
            font-size: 160%;
            top: -7%;
        }

        .fc-icon-left-triangle:after {
            content: "\25C4";
            font-size: 125%;
            top: 3%;
        }

        .fc-icon-right-triangle:after {
            content: "\25BA";
            font-size: 125%;
            top: 3%;
        }

        .fc-icon-down-triangle:after {
            content: "\25BC";
            font-size: 125%;
            top: 2%;
        }

        .fc-icon-x:after {
            content: "\D7";
            font-size: 200%;
            top: 6%;
        }

        /* Popover
--------------------------------------------------------------------------------------------------*/
        .fc-unthemed .fc-popover {
            border-width: 1px;
            border-style: solid;
        }

        .fc-unthemed .fc-popover .fc-header .fc-close {
            font-size: .9em;
            margin-top: 2px;
        }

        /* List View
--------------------------------------------------------------------------------------------------*/
        .fc-unthemed .fc-list-item:hover td {
            background-color: #f5f5f5;
        }

        /* Colors
--------------------------------------------------------------------------------------------------*/
        .ui-widget .fc-disabled-day {
            background-image: none;
        }

        /* Popover
--------------------------------------------------------------------------------------------------*/
        .fc-popover>.ui-widget-header+.ui-widget-content {
            border-top: 0;
            /* where they meet, let the header have the border */
        }

        /* Global Event Styles
--------------------------------------------------------------------------------------------------*/
        .ui-widget .fc-event {
            /* overpower jqui's styles on <a> tags. TODO: more DRY */
            color: #fff;
            /* default TEXT color */
            text-decoration: none;
            /* if <a> has an href */
            /* undo ui-widget-header bold */
            font-weight: normal;
        }

        /* TimeGrid axis running down the side (for both the all-day area and the slot area)
--------------------------------------------------------------------------------------------------*/
        .ui-widget td.fc-axis {
            font-weight: normal;
            /* overcome bold */
        }

        /* TimeGrid Slats (lines that run horizontally)
--------------------------------------------------------------------------------------------------*/
        .fc-time-grid .fc-slats .ui-widget-content {
            background: none;
            /* see through to fc-bg */
        }

        .fc.fc-bootstrap3 a {
            text-decoration: none;
        }

        .fc.fc-bootstrap3 a[data-goto]:hover {
            text-decoration: underline;
        }

        .fc-bootstrap3 hr.fc-divider {
            border-color: inherit;
        }

        .fc-bootstrap3 .fc-today.alert {
            border-radius: 0;
        }

        /* Popover
--------------------------------------------------------------------------------------------------*/
        .fc-bootstrap3 .fc-popover .panel-body {
            padding: 0;
        }

        /* TimeGrid Slats (lines that run horizontally)
--------------------------------------------------------------------------------------------------*/
        .fc-bootstrap3 .fc-time-grid .fc-slats table {
            /* some themes have background color. see through to slats */
            background: none;
        }

        .fc.fc-bootstrap4 a {
            text-decoration: none;
        }

        .fc.fc-bootstrap4 a[data-goto]:hover {
            text-decoration: underline;
        }

        .fc-bootstrap4 hr.fc-divider {
            border-color: inherit;
        }

        .fc-bootstrap4 .fc-today.alert {
            border-radius: 0;
        }

        .fc-bootstrap4 a.fc-event:not([href]):not([tabindex]) {
            color: #5d5386;
        }

        .fc-bootstrap4 .fc-popover.card {
            position: absolute;
        }

        /* Popover
--------------------------------------------------------------------------------------------------*/
        .fc-bootstrap4 .fc-popover .card-body {
            padding: 0;
        }

        /* TimeGrid Slats (lines that run horizontally)
--------------------------------------------------------------------------------------------------*/
        .fc-bootstrap4 .fc-time-grid .fc-slats table {
            /* some themes have background color. see through to slats */
            background: none;
        }

        /* Toolbar
--------------------------------------------------------------------------------------------------*/
        .fc-toolbar {
            text-align: center;
        }

        .fc-toolbar.fc-header-toolbar {
            margin-bottom: 1em;
        }

        .fc-toolbar.fc-footer-toolbar {
            margin-top: 1em;
        }

        .fc-toolbar .fc-left {
            float: left;
        }

        .fc-toolbar .fc-right {
            float: right;
        }

        .fc-toolbar .fc-center {
            display: inline-block;
        }

        .fc button {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            margin: 0;
            height: auto;
            padding: 0 1rem;
            font-size: 1rem;
            white-space: nowrap;
            cursor: pointer;
        }

        /* the things within each left/right/center section */
        .fc .fc-toolbar>*>* {
            /* extra precedence to override button border margins */
            float: left;
            margin-left: .75em;
        }

        /* the first thing within each left/center/right section */
        .fc .fc-toolbar>*> :first-child {
            /* extra precedence to override button border margins */
            margin-left: 0;
        }

        /* title text */
        .fc-toolbar h2 {
            margin: 0;
            font-size: 15px;
            font-weight: 700;
        }

        /* button layering (for border precedence) */
        .fc-toolbar button {
            position: relative;
        }

        .fc-toolbar .fc-state-hover,
        .fc-toolbar .ui-state-hover {
            z-index: 2;
        }

        .fc-toolbar .fc-state-down {
            z-index: 3;
        }

        .fc-toolbar .fc-state-active,
        .fc-toolbar .ui-state-active {
            z-index: 4;
        }

        .fc-toolbar button:focus {
            z-index: 5;
        }

        /* View Structure
--------------------------------------------------------------------------------------------------*/
        /* undo twitter bootstrap's box-sizing rules. normalizes positioning techniques */
        /* don't do this for the toolbar because we'll want bootstrap to style those buttons as some pt */
        .fc-view-container *,
        .fc-view-container *:before,
        .fc-view-container *:after {
            -webkit-box-sizing: content-box;
            -moz-box-sizing: content-box;
            box-sizing: content-box;
        }

        .fc-view,
        .fc-view>table {
            /* so dragged elements can be above the view's main element */
            position: relative;
            z-index: 1;
        }

        /* BasicView
--------------------------------------------------------------------------------------------------*/
        /* day row structure */
        .fc-basicWeek-view .fc-content-skeleton,
        .fc-basicDay-view .fc-content-skeleton {
            /* there may be week numbers in these views, so no padding-top */
            padding-bottom: 1em;
            /* ensure a space at bottom of cell for user selecting/clicking */
        }

        .fc-basic-view .fc-body .fc-row {
            min-height: 4em;
            /* ensure that all rows are at least this tall */
        }

        /* a "rigid" row will take up a constant amount of height because content-skeleton is absolute */
        .fc-row.fc-rigid {
            overflow: hidden;
        }

        .fc-row.fc-rigid .fc-content-skeleton {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
        }

        /* week and day number styling */
        .fc-day-top.fc-other-month {
            opacity: 0.3;
        }

        .fc-basic-view .fc-week-number,
        .fc-basic-view .fc-day-number {
            padding: 2px;
            color: rgba(52, 40, 104, .8);
            font-size: 15px;
            font-weight: 400;
        }

        .fc-basic-view th.fc-week-number,
        .fc-basic-view th.fc-day-number {
            padding: 0 2px;
            /* column headers can't have as much v space */
        }

        .fc-ltr .fc-basic-view .fc-day-top .fc-day-number {
            float: right;
        }

        .fc-rtl .fc-basic-view .fc-day-top .fc-day-number {
            float: left;
        }

        .fc-ltr .fc-basic-view .fc-day-top .fc-week-number {
            float: left;
            border-radius: 0 0 3px 0;
        }

        .fc-rtl .fc-basic-view .fc-day-top .fc-week-number {
            float: right;
            border-radius: 0 0 0 3px;
        }

        .fc-basic-view .fc-day-top .fc-week-number {
            min-width: 1.5em;
            text-align: center;
            background-color: #f2f2f2;
            color: #808080;
        }

        /* when week/day number have own column */
        .fc-basic-view td.fc-week-number {
            text-align: center;
        }

        .fc-basic-view td.fc-week-number>* {
            /* work around the way we do column resizing and ensure a minimum width */
            display: inline-block;
            min-width: 1.25em;
        }

        /* AgendaView all-day area
--------------------------------------------------------------------------------------------------*/
        .fc-agenda-view .fc-day-grid {
            position: relative;
            z-index: 2;
            /* so the "more.." popover will be over the time grid */
        }

        .fc-agenda-view .fc-day-grid .fc-row {
            min-height: 3em;
            /* all-day section will never get shorter than this */
        }

        .fc-agenda-view .fc-day-grid .fc-row .fc-content-skeleton {
            padding-bottom: 1em;
            /* give space underneath events for clicking/selecting days */
        }

        /* TimeGrid axis running down the side (for both the all-day area and the slot area)
--------------------------------------------------------------------------------------------------*/
        .fc .fc-axis {
            /* .fc to overcome default cell styles */
            vertical-align: middle;
            padding: 0 4px;
            white-space: nowrap;
        }

        .fc-ltr .fc-axis {
            text-align: right;
        }

        .fc-rtl .fc-axis {
            text-align: left;
        }

        /* TimeGrid Structure
--------------------------------------------------------------------------------------------------*/
        .fc-time-grid-container,
        .fc-time-grid {
            /* so slats/bg/content/etc positions get scoped within here */
            position: relative;
            z-index: 1;
        }

        .fc-time-grid {
            min-height: 100%;
            /* so if height setting is 'auto', .fc-bg stretches to fill height */
        }

        .fc-time-grid table {
            /* don't put outer borders on slats/bg/content/etc */
            border: 0 hidden transparent;
        }

        .fc-time-grid>.fc-bg {
            z-index: 1;
            background: #fff;
        }

        .fc-time-grid .fc-slats,
        .fc-time-grid>hr {
            /* the <hr> AgendaView injects when grid is shorter than scroller */
            position: relative;
            z-index: 2;
        }

        .fc-time-grid .fc-content-col {
            position: relative;
            /* because now-indicator lives directly inside */
        }

        .fc-time-grid .fc-content-skeleton {
            position: absolute;
            z-index: 3;
            top: 0;
            left: 0;
            right: 0;
        }

        /* divs within a cell within the fc-content-skeleton */
        .fc-time-grid .fc-business-container {
            position: relative;
            z-index: 1;
        }

        .fc-time-grid .fc-bgevent-container {
            position: relative;
            z-index: 2;
        }

        .fc-time-grid .fc-highlight-container {
            position: relative;
            z-index: 3;
        }

        .fc-time-grid .fc-event-container {
            position: relative;
            z-index: 4;
        }

        .fc-time-grid .fc-now-indicator-line {
            z-index: 5;
        }

        .fc-time-grid .fc-helper-container {
            /* also is fc-event-container */
            position: relative;
            z-index: 6;
        }

        /* TimeGrid Slats (lines that run horizontally)
--------------------------------------------------------------------------------------------------*/
        .fc-time-grid .fc-slats td {
            height: 1.5em;
            border-bottom: 0;
            padding: 10px;
            /* each cell is responsible for its top border */
        }

        .fc-agendaDay-view .fc-time-grid .fc-slats td {
            background: #ffffff;
        }

        .fc-time-grid .fc-slats .fc-minor td {
            border-top-style: dotted;
        }

        /* TimeGrid Highlighting Slots
--------------------------------------------------------------------------------------------------*/
        .fc-time-grid .fc-highlight-container {
            /* a div within a cell within the fc-highlight-skeleton */
            position: relative;
            /* scopes the left/right of the fc-highlight to be in the column */
        }

        .fc-time-grid .fc-highlight {
            position: absolute;
            left: 0;
            right: 0;
            /* top and bottom will be in by JS */
        }

        /* TimeGrid Event Containment
--------------------------------------------------------------------------------------------------*/
        .fc-ltr .fc-time-grid .fc-event-container {
            /* space on the sides of events for LTR (default) */
            margin: 0 2.5% 0 2px;
        }

        .fc-rtl .fc-time-grid .fc-event-container {
            /* space on the sides of events for RTL */
            margin: 0 2px 0 2.5%;
        }

        .fc-time-grid .fc-event,
        .fc-time-grid .fc-bgevent {
            position: absolute;
            z-index: 1;
            /* scope inner z-index's */
        }

        .fc-time-grid .fc-bgevent {
            /* background events always span full width */
            left: 0;
            right: 0;
        }

        /* Generic Vertical Event
--------------------------------------------------------------------------------------------------*/
        .fc-v-event.fc-not-start {
            /* events that are continuing from another day */
            /* replace space made by the top border with padding */
            border-top-width: 0;
            padding-top: 1px;
            /* remove top rounded corners */
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

        .fc-v-event.fc-not-end {
            /* replace space made by the top border with padding */
            border-bottom-width: 0;
            padding-bottom: 1px;
            /* remove bottom rounded corners */
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
        }

        /* TimeGrid Event Styling
----------------------------------------------------------------------------------------------------
We use the full "fc-time-grid-event" class instead of using descendants because the event won't
be a descendant of the grid when it is being dragged.
*/
        .fc-time-grid-event {
            overflow: hidden;
            /* don't let the bg flow over rounded corners */
        }

        .fc-time-grid-event.fc-selected {
            /* need to allow touch resizers to extend outside event's bounding box */
            /* common fc-selected styles hide the fc-bg, so don't need this anyway */
            overflow: visible;
        }

        .fc-time-grid-event.fc-selected .fc-bg {
            display: none;
            /* hide semi-white background, to appear darker */
        }

        .fc-time-grid-event .fc-content {
            overflow: hidden;
            /* for when .fc-selected */
        }

        .fc-time-grid-event .fc-time,
        .fc-time-grid-event .fc-title {
            padding: 0 1px;
        }

        .fc-time-grid-event .fc-time {
            font-size: .85em;
            white-space: nowrap;
        }

        /* short mode, where time and title are on the same line */
        .fc-time-grid-event.fc-short .fc-content {
            /* don't wrap to second line (now that contents will be inline) */
            white-space: nowrap;
        }

        .fc-time-grid-event.fc-short .fc-time,
        .fc-time-grid-event.fc-short .fc-title {
            /* put the time and title on the same line */
            display: inline-block;
            vertical-align: top;
        }

        .fc-time-grid-event.fc-short .fc-time span {
            display: none;
            /* don't display the full time text... */
        }

        .fc-time-grid-event.fc-short .fc-time:before {
            content: attr(data-start);
            /* ...instead, display only the start time */
        }

        .fc-time-grid-event.fc-short .fc-time:after {
            content: "\A0-\A0";
            /* seperate with a dash, wrapped in nbsp's */
        }

        .fc-time-grid-event.fc-short .fc-title {
            font-size: .85em;
            /* make the title text the same size as the time */
            padding: 0;
            /* undo padding from above */
        }

        /* resizer (cursor device) */
        .fc-time-grid-event.fc-allow-mouse-resize .fc-resizer {
            left: 0;
            right: 0;
            bottom: 0;
            height: 8px;
            overflow: hidden;
            line-height: 8px;
            font-size: 11px;
            font-family: monospace;
            text-align: center;
            cursor: s-resize;
        }

        .fc-time-grid-event.fc-allow-mouse-resize .fc-resizer:after {
            content: "=";
        }

        /* resizer (touch device) */
        .fc-time-grid-event.fc-selected .fc-resizer {
            /* 10x10 dot */
            border-radius: 5px;
            border-width: 1px;
            width: 8px;
            height: 8px;
            border-style: solid;
            border-color: inherit;
            background: #fff;
            /* horizontally center */
            left: 50%;
            margin-left: -5px;
            /* center on the bottom edge */
            bottom: -5px;
        }

        /* Now Indicator
--------------------------------------------------------------------------------------------------*/
        .fc-time-grid .fc-now-indicator-line {
            border-top-width: 1px;
            left: 0;
            right: 0;
        }

        /* arrow on axis */
        .fc-time-grid .fc-now-indicator-arrow {
            margin-top: -5px;
            /* vertically center on top coordinate */
        }

        .fc-ltr .fc-time-grid .fc-now-indicator-arrow {
            left: 0;
            /* triangle pointing right... */
            border-width: 5px 0 5px 6px;
            border-top-color: transparent;
            border-bottom-color: transparent;
        }

        .fc-rtl .fc-time-grid .fc-now-indicator-arrow {
            right: 0;
            /* triangle pointing left... */
            border-width: 5px 6px 5px 0;
            border-top-color: transparent;
            border-bottom-color: transparent;
        }

        /* List View
--------------------------------------------------------------------------------------------------*/
        /* possibly reusable */
        .fc-event-dot {
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 5px;
        }

        /* view wrapper */
        .fc-rtl .fc-list-view {
            direction: rtl;
            /* unlike core views, leverage browser RTL */
        }

        .fc-list-view {
            border-width: 1px;
            border-style: solid;
        }

        /* table resets */
        .fc .fc-list-table {
            table-layout: auto;
            /* for shrinkwrapping cell content */
        }

        .fc-list-table td {
            border-width: 1px 0 0;
            padding: 8px 14px;
        }

        .fc-list-table tr:first-child td {
            border-top-width: 0;
        }

        /* day headings with the list */
        .fc-list-heading {
            border-bottom-width: 1px;
        }

        .fc-list-heading td {
            font-weight: bold;
        }

        .fc-ltr .fc-list-heading-main {
            float: left;
        }

        .fc-ltr .fc-list-heading-alt {
            float: right;
        }

        .fc-rtl .fc-list-heading-main {
            float: right;
        }

        .fc-rtl .fc-list-heading-alt {
            float: left;
        }

        /* event list items */
        .fc-list-item.fc-has-url {
            cursor: pointer;
            /* whole row will be clickable */
        }

        .fc-list-item-marker,
        .fc-list-item-time {
            white-space: nowrap;
            width: 1px;
        }

        /* make the dot closer to the event title */
        .fc-ltr .fc-list-item-marker {
            padding-right: 0;
        }

        .fc-rtl .fc-list-item-marker {
            padding-left: 0;
        }

        .fc-list-item-title a {
            /* every event title cell has an <a> tag */
            text-decoration: none;
            color: inherit;
        }

        .fc-list-item-title a[href]:hover {
            /* hover effect only on titles with hrefs */
            text-decoration: underline;
        }

        /* message when no events */
        .fc-list-empty-wrap2 {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }

        .fc-list-empty-wrap1 {
            width: 100%;
            height: 100%;
            display: table;
        }

        .fc-list-empty {
            display: table-cell;
            vertical-align: middle;
            text-align: center;
        }

        .fc-unthemed .fc-list-empty {
            /* theme will provide own background */
            background-color: #eee;
        }


        .fc th.fc-day-header {
            padding: 11px 7px;
            font-size: 16px;
            font-weight: 400;
        }

        .fc-day.fc-today {
            background: rgba(52, 40, 104, .03);
        }

        .fc-day.alert-info {
            background: rgba(52, 40, 104, .03);
        }

        .datepicker {
            z-index: 123456;
        }

        body {
            font-family: 'Montserrat', 'Nunito', sans-serif;
            background: #F3F5F9;
        }

        .card {
            border: 0;
            background: transparent;
        }

        h2 {
            text-transform: uppercase;
            font-weight: 700;
            font-size: 22px;
            text-align: center;
            letter-spacing: 1px;
            font-family: 'Montserrat', sans-serif;
            color: #002147;
            margin-bottom: 20px;
        }

        .btn {
            font-size: 15px !important;
            text-transform: uppercase;
            font-weight: 700;
            box-shadow: none !important;
            border: 0;
            padding: 10px 30px !important;
            border-radius: 50px;
        }

        .btn-button {
            font-size: 25px !important;
            text-transform: uppercase;
            font-weight: 700;
            box-shadow: none !important;
            border: 0;
            padding: 20px 50px !important;
            border-radius: 50px;
            text-decoration: none;
        }

        .btn:focus {
            box-shadow: none;
        }

        .btn.btn-primary,
        .btn-button.btn-primary {
            background: #202020;
            color: #ffffff;
        }

        .btn.btn-primary:hover,
        .btn-button.btn-primary:hover,
        .btn.btn-primary.selected {
            background-color: #02D07A;
            text-decoration: none;
        }

        .form-group label {
            font-weight: 600;
            letter-spacing: 0.010em;
            font-size: 18px;
            margin-bottom: 5px;
        }

        .modal-body {
            background: #F3F5F9;
            border-radius: 10px;
        }

        .modal-body h4 {
            text-transform: uppercase;
            font-weight: 700;
            font-size: 18px;
            letter-spacing: 1px;
            font-family: 'Montserrat', sans-serif;
            color: #002147;
            margin-bottom: 20px;
        }

        .modal-body .form-control {
            box-shadow: none;
            height: 50px;
        }


        /* related product */
        .related-product {
            padding: 80px 0;
        }

        .related-product .container {
            max-width: 1200px;
            width: 100%;
            margin: 0 auto;
        }

        .related-product ul {
            padding: 0;
            margin: 0;
        }

        .related-product ul li {
            margin-bottom: 30px;
            list-style-type: none;
        }

        .related-product ul li h3 {
            font-weight: 700;
            font-size: 24px;
            padding: 20px 0;
        }

        .related-product ul li a {
            font-weight: 600;
            color: #3b484a;
            text-align: center;
        }

        .related-product ul li a img {
            max-width: 100%;
            display: block;
        }

        .related-box {
            max-width: 400px;
            margin: 0 auto;
        }

        .download-btn {
            padding: 15px;
            display: inline-flex;
            align-items: center;
        }

        .download-btn .fa {
            font-size: 40px;
            margin-right: 10px;
        }

        h1 {
            font-size: 20px;
            text-transform: uppercase;
            font-weight: bold;
        }

        .card {
            background: #f2f2f2;
            padding: 20px;
            margin: 70px 0;
            border-radius: 10px;
            min-height: 322px;
        }

        .card h3 {
            font-size: 20px;
            text-align: center;
        }

        .card .grid-atendimento ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .card .grid-atendimento ul li {
            display: grid;
            grid-template-columns: 50px 1fr;
            grid-template-areas: "dia horario";
            font-size: 14px;
            border-bottom: 1px solid;
            padding: 10px;
        }

        .card .grid-atendimento ul li:last-child {
            border-bottom: 0;
        }

        .card .grid-atendimento ul li .dia {
            grid-area: dia;
        }

        .card .grid-atendimento ul li .horario {
            grid-area: horario;
            text-align: right;
        }

        .card .botoes-contato {
            display: grid;
            grid-template-columns: 1fr;
            margin-top: 30px;
        }

        .card .botoes-contato a {
            text-align: center;
            font-size: 20px;
            padding: 5px 0;
            color: #000;
            text-decoration: none;
        }

        .card .botoes-contato a:hover {
            background-color: #000;
            border-radius: 20px;
            color: #FFF;
        }

        .card .botoes-contato a.btn-whatsapp:hover {
            background-color: #02D07A;
        }

        .card .botoes-contato a.btn-maps:hover {
            background-color: #002147;
        }

        .card .botoes-contato a.btn-instagram:hover {
            background-color: #ff047a;
        }

        .slide-funcionarios a {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #000;
            font-weight: 600;
            border-radius: 100px;
            background: #ededed;
            text-decoration: none;
        }

        .slide-funcionarios a:hover,
        .slide-funcionarios a.active {
            background: {{ $estabelecimento->cor_primaria }};
        }

        .slide-funcionarios a figure {
            margin: 0;
        }


        .slide-funcionarios a img {
            border-radius: 100%;
            border: 2px solid #000;
            max-width: 90px;
            max-height: 90px;
        }

        .form-buscar {
            width: 100%;
            border: 2px solid #000;
            border-radius: 20px;
            display: flex;
            align-items: center;
            padding: 0 20px;
        }

        .form-buscar input,
        input[type="text"],
        input[type="email"],
        input[type="tel"] {
            font-size: 14px;
            outline: none;
            width: 100%;
            padding: 10px;
            background: transparent;
            border: 2px solid #000;
            border-radius: 20px;
        }

        textarea {
            font-size: 14px;
            outline: none;
            width: 100%;
            padding: 10px;
            background: transparent;
            border: 2px solid #000;
            border-radius: 20px;
        }

        .form-buscar input {
            border: 0;
        }

        .servico-item a {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #000;
            font-weight: 600;
            border-radius: 100px;
            background: #ededed;
            text-decoration: none;
        }

        .form-buscar {
            position: relative;
        }

        .results-servico {
            padding: 20px 13px;
            max-height: 310px;
            overflow: scroll;
        }

        .order-resume {
            background: #000;
            color: #FFF;
            border-radius: 100px;
            padding: 15px 20px;
            text-align: center;
        }

        .box-payment {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr;
            gap: 10px;
        }

        .payment-button {
            border-radius: 10px;
            padding: 10px 14px;
            text-transform: uppercase;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 5px;
            font-size: 12px;
            font-weight: bold;
            background: linear-gradient(92deg, #ECECEC 1.13%, #D7D7D7 99.34%);
            border: 0;
            cursor: pointer;
        }

        .payment-button.active,
        .payment-button:hover {
            background: linear-gradient(92deg, #29D27F 1.13%, #52ECA2 99.34%);
        }

        .payment-button i {
            font-size: 27px;
        }

        .btAgendar {
            background: #000;
            color: #FFF;
            border-radius: 100px;
            padding: 15px 20px;
            text-align: center;
            cursor: pointer;
            width: 100%;
            font-weight: bold;
        }

        .btAgendar:disabled {
            background-color: #ccc;
            color: #666;
            cursor: not-allowed;
        }
    </style>
</head>

<body class="antialiased sans-serif bg-gray-100">
    @include('template-parts/header')
    {{-- {{$estabelecimento}} --}}
    <main>
        <div class="container py-5">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h1>Informe seus dados:</h1>
                </div>



                <div class="col-12 py-3">
                    <div class="form-group">
                        <input name="nome" type="text" id="nome" placeholder="Digite seu nome..." required>
                    </div>

                    <div class="form-group">
                        <input name="email" type="email" id="email" placeholder="Informe o seu e-mail..."
                            required>
                        <div class="invalid-feedback">Digite um e-mail válido.</div>
                    </div>

                    <div class="form-group">
                        <input name="telefone" type="tel" id="telefone" placeholder="Digite seu WhatsApp ..."
                            required>
                        <small class="form-text text-muted">Apenas números</small>
                    </div>
                </div>
            </div>

            <div class="row" id="formAgendar">
                <div class="col-sm-12 text-center">
                    <h1>Escolha o funcionário:</h1>
                </div>

                <div class="col-12 py-3 pb-5">
                    <!-- Slider main container -->
                    <div class="swiper">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            @foreach ($funcionarios as $funcionario)
                                <div class="swiper-slide slide-funcionarios">
                                    <a href="#" class="funcionario-item" data-id="{{ $funcionario->id }}"
                                        data-nome="{{ $funcionario->nome }}">
                                        <figure class="rounded">
                                            <img src="{{ $funcionario->foto ? $funcionario->foto : 'https://placehold.it/80x80' }}"
                                                alt="">
                                        </figure>
                                        <span class="title-profissional">{{ $funcionario->nome }}</span>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 text-center">
                    <h1>Escolha o(s) serviço(s):</h1>
                </div>
                <div class="col-12 py-3 pb-5">
                    <div class="form-buscar">
                        <i class="fa fa-search" aria-hidden="true"></i>
                        <input type="text" class="search-servico" placeholder="Digite para filtrar">
                    </div>
                    <div class="results-servico">
                        @foreach ($servicos as $servico)
                            <div class="servico-item" data-id="{{ $servico->id }}" data-name="{{ $servico->nome }}"
                                data-price="{{ $servico->valor }}">
                                <div>
                                    <input type="checkbox" id="{{ $servico->id }}" name="servicos[]"
                                        value="{{ $servico->id }}">
                                    <label for="{{ $servico->id }}">{{ $servico->nome }} - R$
                                        {{ number_format($servico->valor / 100, 2, ',', '.') }}</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="order-resume">
                        Total: <strong>R$ 0,00</strong>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 text-center">
                    <h1>Escolha a forma de pagamento:</h1>
                </div>

                <div class="col-12 py-3 pb-5 box-payment">
                    <button class="payment-button" data-id="1" data-name="Pix">
                        <svg width="29" height="26" viewBox="0 0 29 26" fill="none"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <rect y="0.391357" width="28.3182" height="24.6522" fill="url(#pattern0)" />
                            <defs>
                                <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1"
                                    height="1">
                                    <use xlink:href="#image0_606_720"
                                        transform="matrix(0.00195312 0 0 0.00224357 0 -0.0743547)" />
                                </pattern>
                                <image id="image0_606_720" width="512" height="512"
                                    xlink:href="data:image/png;base64,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" />
                            </defs>
                        </svg>
                        PIX
                    </button>

                    <button class="payment-button" data-id="2" data-name="Cartão de débito">
                        <i class="fa fa-credit-card"></i>
                        Débito
                    </button>

                    <button class="payment-button" data-id="3" data-name="Cartão de crédito">
                        <i class="fa fa-credit-card"></i>
                        Crédito
                    </button>

                    <button class="payment-button" data-id="4" data-name="Dinheiro">
                        <i class="fa fa-money"></i>
                        Dinheiro
                    </button>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 text-center">
                    <h1>Escolha a data e horário do seu agendamento:</h1>
                </div>

                <div class="col-12 py-3 pb-5">
                    <div class="grid-week">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 text-center">
                    <h1>Observações:</h1>
                </div>

                <div class="col-12 py-3 pb-5">
                    <div class="form-group">
                        <textarea name="observacoes" id="observacoes" cols="30" rows="10"></textarea>
                        <small class="form-text text-muted">Escreva aqui caso tenha alguma observação.</small>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <button class="btAgendar" >Finalizar Agendamento</button>
                </div>
            </div>

            <style>
                .steps-header {
                    display: grid;
                    grid-template-columns: 50px 1fr 1fr 1fr;
                    margin: 50px 0;
                }

                .steps-header .number {
                    display: grid;
                    grid-template-columns: 1fr 50px;
                    align-items: center;
                }

                .steps-header .number span {
                    width: 50px;
                    height: 50px;
                    border-radius: 100%;
                    background: #000;
                    color: #FFFFFF;
                    font-size: 20px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }

                .steps-header .number:before {
                    content: " ";
                    width: 100%;
                    height: 3px;
                    background: #000;
                    display: block;
                }

                .steps-header .number:first-child {
                    grid-template-columns: 50px 1fr;
                }

                .steps-header .number:first-child:before {
                    display: none;
                }

                .steps-header .number:last-child {
                    grid-template-columns: 1fr 50px;
                }

                .steps-header .number:last-child:after {
                    display: none;
                }

                .steps-header .number.active span {
                    background: #02D07A;
                    font-weight: bold;
                }

                .steps-header .number.active:before {
                    background: #02D07A;
                }

                .lista-de-profissionais,
                .lista-de-servicos {
                    list-style-type: none;
                    margin: 20px auto;
                    padding: 0;
                }

                .lista-de-profissionais li,
                .lista-de-servicos li {
                    margin-bottom: 20px;
                }

                .lista-de-profissionais li a,
                .lista-de-servicos li a {
                    display: grid;
                    grid-template-columns: 100px 1fr 20px;
                    align-items: center;
                    border-bottom: 2px solid #000;
                    padding: 20px 0;
                    color: #000000;
                }

                .lista-de-servicos li a {
                    grid-template-columns: 100px 1fr 170px;
                }

                .lista-de-servicos li a.is-promotion .title-profissional:before {
                    content: "Promoção";
                    background: #ff047a;
                    color: #FFF;
                    font-weight: bold;
                    font-size: 12px;
                    text-transform: uppercase;
                    border-radius: 20px;
                    padding: 5px 15px;
                }

                .lista-de-profissionais li a:after {
                    content: "+";
                    font-weight: 900;
                    font-size: 20px;
                }

                .lista-de-profissionais li a figure {
                    margin: 0;
                }

                .lista-de-profissionais li a span {
                    font-size: 18px;
                    font-weight: bold;
                }

                #step1,
                #step2,
                #step3,
                #step4 {
                    display: none;
                }

                .grid-week {
                    width: 100%;
                }

                .grid-week>div {
                    border: 1px solid #ccc;
                    padding: 10px;
                    text-align: center;
                    display: grid;
                    grid-template-columns: repeat(30, 1fr);
                    overflow-x: scroll;
                    gap: 1px;
                    border-radius: 10px
                }

                .time-row {
                    min-height: 50px;
                }

                .button-list {}

                .button-list button {
                    padding: 5px;
                    border-radius: 10px;
                    margin: 10px 4px;
                    min-width: 91px;
                    display: grid;
                    cursor: pointer;
                    background: linear-gradient(92deg, #ECECEC 1.13%, #D7D7D7 99.34%);
                    border: 0;
                }

                .button-list button:hover,
                .button-list button.active {
                    background: linear-gradient(92deg, #29D27F 1.13%, #52ECA2 99.34%);
                }

                .button-list button.empty {
                    background-color: #CCCCCC;
                    color: #666666;
                    cursor: not-allowed;
                }

                .button-list button .day {
                    font-size: 12px;
                }

                .button-list button .date {
                    font-size: 20px;
                    font-weight: bold;
                }

                .button-list button .year {
                    font-size: 12px;
                }

                .calendarResult {
                    grid-template-columns: 1fr !important;
                    padding: 30px !important;
                }

                .calendarResult button {
                    border: 1px solid #202020;
                    padding: 10px;
                    border-radius: 10px;
                    margin: 10px;
                    display: grid;
                    background: #F6F6F6;
                    color: #202020;
                    cursor: pointer;
                    width: 100%;
                    border-radius: 40px;
                }

                .calendarResult button:hover,
                .calendarResult button.active {
                    background-color: #02D07A;
                    border-color: #02D07A;
                }

                .calendarResult button.empty {
                    background-color: #CCCCCC;
                    color: #666666;
                    cursor: not-allowed;
                }

                #loading {
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    z-index: 9999;
                }

                .overlay {
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background-color: rgba(0, 0, 0, 0.5);
                }

                .spinner {
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                }

                .spinner>div {
                    width: 12px;
                    height: 12px;
                    margin-right: 4px;
                    background-color: #ffffff;
                    border-radius: 100%;
                    display: inline-block;
                    animation: bounce 1.4s infinite ease-in-out both;
                }

                .spinner .bounce1 {
                    animation-delay: -0.32s;
                }

                .spinner .bounce2 {
                    animation-delay: -0.16s;
                }



                @keyframes bounce {

                    0%,
                    80%,
                    100% {
                        transform: scale(0);
                    }

                    40% {
                        transform: scale(1);
                    }
                }
            </style>
            {{-- <div id="loading">
                <div class="overlay"></div>
                <div class="spinner">
                    <div class="bounce1"></div>
                    <div class="bounce2"></div>
                    <div class="bounce3"></div>
                </div>
            </div> --}}


            <div class="row box-infos">
                <div class="col-sm-4">
                    <div class="card">
                        <h3>Horário de Atendimento</h3>
                        <div class="grid-atendimento">
                            <ul>
                                <li>
                                    <span class="dia">Seg.</span>
                                    <span class="horario">{{date("H:i", strtotime($estabelecimento->segunda_horario_inicio))}} - {{date("H:i", strtotime($estabelecimento->segunda_horario_fim))}}</span>
                                </li>
                                <li>
                                    <span class="dia">Ter.</span>
                                    <span class="horario">{{date("H:i", strtotime($estabelecimento->terca_horario_inicio))}} - {{date("H:i", strtotime($estabelecimento->terca_horario_fim))}}</span>
                                </li>
                                <li>
                                    <span class="dia">Qua.</span>
                                    <span class="horario">{{date("H:i", strtotime($estabelecimento->quarta_horario_inicio))}} - {{date("H:i", strtotime($estabelecimento->quarta_horario_fim))}}</span>
                                </li>
                                <li>
                                    <span class="dia">Qui.</span>
                                    <span class="horario">{{date("H:i", strtotime($estabelecimento->quinta_horario_inicio))}} - {{date("H:i", strtotime($estabelecimento->quinta_horario_fim))}}</span>
                                </li>
                                <li>
                                    <span class="dia">Sex.</span>
                                    <span class="horario">{{date("H:i", strtotime($estabelecimento->sexta_horario_inicio))}} - {{date("H:i", strtotime($estabelecimento->sexta_horario_fim))}}</span>
                                </li>
                                <li>
                                    <span class="dia">Sab.</span>
                                    <span class="horario">{{date("H:i", strtotime($estabelecimento->sabado_horario_inicio))}} - {{date("H:i", strtotime($estabelecimento->sabado_horario_fim))}}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="card">
                        <h3>Contato</h3>
                        <div class="botoes-contato">
                            <a href="tel:5571981575883" class="btn-telefone"><i class="fa fa-phone"></i> {{$estabelecimento->telefone}}</a>
                            <a href="{{str_replace(array("-", "(", ")"), "",$estabelecimento->telefone)}}" class="btn-whatsapp"><i class="fa fa-whatsapp"></i>
                                {{$estabelecimento->telefone}}</a>
                            <a href="{{str_replace(array("-", "(", ")"), "",$estabelecimento->telefone)}}" class="btn-whatsapp"><i class="fa fa-whatsapp"></i>
                                {{$estabelecimento->telefone}}</a>
                            <a href="{{$estabelecimento->instagram}}" class="btn-instagram"><i class="fa fa-instagram"></i>
                                Instagram</a>
                            <a href="https://maps.google.com" class="btn-maps"><i class="fa fa-map"></i> Traçar
                                Rota</a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="card">
                        <h3>Localização</h3>
                        <iframe
                            src="https://www.google.com.br/maps?q={{$estabelecimento->cep}},%20Brasil&output=embed"
                            width="600" height="450" style="border:0; width: 100%; height: 250px"
                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </main>


    @include('template-parts/footer')
</body>

</html>
