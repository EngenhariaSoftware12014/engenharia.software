
/* FILE: common.css.php */
/******************************************************************************/

/* general tags */
html {
    font-size: 82%}

input,
select,
textarea {
    font-size: 1em;
}


body {
    font-family:        sans-serif;
    padding:            0;
    margin: 0;
    margin-left: 240px;
    color:              #000000;
    background:         #F5F5F5;
}

body#loginform {
    margin: 0;
}

#page_content {
    margin: 0 .5em;
}

textarea, tt, pre, code {
    font-family:        monospace;
}
h1 {
    font-size:          140%;
    font-weight:        bold;
}

h2 {
    font-size:          120%;
    font-weight:        bold;
}

h3 {
    font-weight:        bold;
}

a, a:link,
a:visited,
a:active {
    text-decoration:    none;
    color:              #0000FF;
    cursor:             pointer;
}

a:hover {
    text-decoration:    underline;
    color:              #FF0000;
}

dfn {
    font-style:         normal;
}

dfn:hover {
    font-style:         normal;
    cursor:             help;
}

th {
    font-weight:        bold;
    color:              #000000;
    background:         #D3DCE3;
}

a img {
    border:             0;
}

hr {
    color:              #000000;
    background-color:   #000000;
    border:             0;
    height:             1px;
}

form {
    padding:            0;
    margin:             0;
    display:            inline;
}

textarea {
    overflow:           visible;
    height:             9em;
}

textarea.char {
    height:             3em;
}

fieldset {
    margin-top:         1em;
    border:             #000000 solid 1px;
    padding:            0.5em;
    background:         #E5E5E5;
}

fieldset fieldset {
    margin:             0.8em;
}

fieldset legend {
    font-weight:        bold;
    color:              #444444;
    background-color:   transparent;
}

.some-margin {
    margin: .5em;
    margin-top: 1em;
}

/* buttons in some browsers (eg. Konqueror) are block elements,
   this breaks design */
button {
    display:            inline;
}

table caption,
table th,
table td {
    padding:            0.1em 0.5em 0.1em 0.5em;
    margin:             0.1em;
    vertical-align:     top;
}

img,
input,
select,
button {
    vertical-align:     middle;
}

/******************************************************************************/
/* classes */
.clearfloat {
    clear: both;
}

.floatleft {
    float: left;
    margin-right: 1em;
}

table.nospacing {
    border-spacing: 0;
}

table.nopadding tr th, table.nopadding tr td {
    padding: 0;
}

th.left, td.left {
    text-align: left;
}

th.center, td.center {
    text-align: center;
}

th.right, td.right {
    text-align: right;
}

tr.vtop, th.vtop, td.vtop {
    vertical-align: top;
}

tr.vmiddle, th.vmiddle, td.vmiddle {
    vertical-align: middle;
}

tr.vbottom, th.vbottom, td.vbottom {
    vertical-align: bottom;
}

.paddingtop {
    padding-top: 1em;
}

div.tools {
    border: 1px solid #000000;
    padding: 0.2em;
}

div.tools,
fieldset.tblFooters {
    margin-top:         0;
    margin-bottom:      0.5em;
    /* avoid a thick line since this should be used under another fieldset */
    border-top:         0;
    text-align:         right;
    float:              none;
    clear:              both;
}

div.null_div {
    height: 20px;
    text-align: center;
    font-style:normal;
    min-width:50px;
}

fieldset .formelement {
    float:              left;
    margin-right:       0.5em;
    /* IE */
    white-space:        nowrap;
}

/* revert for Gecko */
fieldset div[class=formelement] {
    white-space:        normal;
}

button.mult_submit {
    border:             none;
    background-color:   transparent;
}

/* odd items 1,3,5,7,... */
table tr.odd th,
.odd {
    background: #E5E5E5;
}

/* even items 2,4,6,8,... */
table tr.even th,
.even {
    background: #D5D5D5;
}

/* odd table rows 1,3,5,7,... */
table tr.odd th,
table tr.odd,
table tr.even th,
table tr.even {
    text-align:         left;
}

/* marked table rows */
td.marked,
table tr.marked td,
table tr.marked th,
table tr.marked {
    background:   #FFCC99;
    color:   #000000;
}

/* hovered items */
.odd:hover,
.even:hover,
.hover {
    background: #CCFFCC;
    color: #000000;
}

/* hovered table rows */
table tr.odd:hover th,
table tr.even:hover th,
table tr.hover th {
    background:   #CCFFCC;
    color:   #000000;
}

/**
 * marks table rows/cells if the db field is in a where condition
 */
td.condition,
th.condition {
    border: 1px solid #FFCC99;
}

/**
 * cells with the value NULL
 */
td.null {
    font-style: italic;
    text-align: right;
}

table .valueHeader {
    text-align:         right;
    white-space:        normal;
}
table .value {
    text-align:         right;
    white-space:        normal;
}
/* IE doesnt handles 'pre' right */
table [class=value] {
    white-space:        normal;
}


.value {
    font-family:        monospace;
}
.attention {
    color:              red;
    font-weight:        bold;
}
.allfine {
    color:              green;
}


img.lightbulb {
    cursor:             pointer;
}

.pdflayout {
    overflow:           hidden;
    clip:               inherit;
    background-color:   #FFFFFF;
    display:            none;
    border:             1px solid #000000;
    position:           relative;
}

.pdflayout_table {
    background:         #D3DCE3;
    color:              #000000;
    overflow:           hidden;
    clip:               inherit;
    z-index:            2;
    display:            inline;
    visibility:         inherit;
    cursor:             move;
    position:           absolute;
    font-size:          80%;
    border:             1px dashed #000000;
}

/* Doc links in SQL */
.cm-sql-doc {
    text-decoration: none;
    border-bottom: 1px dotted #000;
    color: inherit !important;
}

/* leave some space between icons and text */
.icon {
    vertical-align:     middle;
    margin-right:       0.3em;
    margin-left:        0.3em;
}

/* no extra space in table cells */
td .icon {
    margin: 0;
}

.selectallarrow {
    margin-right: 0.3em;
    margin-left: 0.6em;
}

/* message boxes: error, confirmation */
#pma_errors, #pma_demo {
    padding: 0 0.5em;
}

.success h1,
.notice h1,
div.error h1 {
    border-bottom:      2px solid;
    font-weight:        bold;
    text-align:         left;
    margin:             0 0 0.2em 0;
}

div.success,
div.notice,
div.error {
    margin:             0.3em 0 0 0;
    border:             2px solid;
    background-repeat:  no-repeat;
            background-position: 10px 50%;
    padding:            0.1em 0.1em 0.1em 36px;
        }

.success {
    color:              #000000;
    background-color:   #f0fff0;
}
h1.success,
div.success {
    border-color:       #00FF00;
}
.success h1 {
    border-color:       #00FF00;
}

.notice {
    color:              #000000;
    background-color:   #FFFFDD;
}
h1.notice,
div.notice {
    border-color:       #FFD700;
}
.notice h1 {
    border-color:       #FFD700;
}

.error {
    background-color:   #FFFFCC;
    color:              #ff0000;
}

h1.error,
div.error {
    border-color:       #ff0000;
}
div.error h1 {
    border-color:       #ff0000;
}

.confirmation {
    background-color:   #FFFFCC;
}
fieldset.confirmation {
    border:             0.1em solid #FF0000;
}
fieldset.confirmation legend {
    border-left:        0.1em solid #FF0000;
    border-right:       0.1em solid #FF0000;
    font-weight:        bold;
    background-image:   url(./themes/original/img/s_really.png);
    background-repeat:  no-repeat;
            background-position: 5px 50%;
    padding:            0.2em 0.2em 0.2em 25px;
        }
/* end messageboxes */


.tblcomment {
    font-size:          70%;
    font-weight:        normal;
    color:              #000099;
}

.tblHeaders {
    font-weight:        bold;
    color:              #000000;
    background:         #D3DCE3;
}

div.tools,
.tblFooters {
    font-weight:        normal;
    color:              #000000;
    background:         #D3DCE3;
}

.tblHeaders a:link,
.tblHeaders a:active,
.tblHeaders a:visited,
div.tools a:link,
div.tools a:visited,
div.tools a:active,
.tblFooters a:link,
.tblFooters a:active,
.tblFooters a:visited {
    color:              #0000FF;
}

.tblHeaders a:hover,
div.tools a:hover,
.tblFooters a:hover {
    color:              #FF0000;
}

/* forbidden, no privilegs */
.noPrivileges {
    color:              #FF0000;
    font-weight:        bold;
}

/* disabled text */
.disabled,
.disabled a:link,
.disabled a:active,
.disabled a:visited {
    color:              #666666;
}

.disabled a:hover {
    color:              #666666;
    text-decoration:    none;
}

tr.disabled td,
td.disabled {
    background-color:   #cccccc;
}

.nowrap {
    white-space:        nowrap;
}

/**
 * zoom search
 */
div#resizer {
    width:              600px;
    height:             400px;
}
div#querychart {
    float:              left;
    width:              600px;
}

/**
 * login form
 */
body#loginform h1,
body#loginform a.logo {
    display: block;
    text-align: center;
}

body#loginform {
    margin-top: 1em;
    text-align: center;
}

body#loginform div.container {
    text-align: left;
    width: 30em;
    margin: 0 auto;
}

form.login label {
    float: left;
    width: 10em;
    font-weight: bolder;
}

.commented_column {
    border-bottom: 1px dashed black;
}

.column_attribute {
    font-size: 70%;
}

/******************************************************************************/
/* specific elements */

/* topmenu */
ul#topmenu, ul#topmenu2, ul.tabs {
    font-weight:        bold;
    list-style-type:    none;
    margin:             0;
    padding:            0;
}

ul#topmenu2 {
    margin: 0.25em 0.5em 0;
    height: 2em;
    clear: both;
}

ul#topmenu li, ul#topmenu2 li {
    float:              left;
    margin:             0;
    padding:            0;
    vertical-align:     middle;
}

#topmenu img, #topmenu2 img {
    vertical-align:     middle;
    margin-right:       0.1em;
}

/* default tab styles */
ul#topmenu a, ul#topmenu span {
    display:            block;
    margin:             2px 2px 0;
    padding:            2px 2px 0;
    white-space:        nowrap;
}

ul#topmenu2 a {
    display:            block;
    margin:             0.1em;
    padding:            0.2em;
    white-space:        nowrap;
}

fieldset.caution a {
    color:              #FF0000;
}
fieldset.caution a:hover {
    color:              #ffffff;
    background-color:   #FF0000;
}

#topmenu {
    margin-top:         0.5em;
    padding:            0.1em 0.3em 0.1em 0.3em;
}

ul#topmenu ul {
    -moz-box-shadow:    2px 2px 3px #666;
    -webkit-box-shadow: 2px 2px 3px #666;
    box-shadow:         2px 2px 3px #666;
}

ul#topmenu > li {
    border-bottom:      1pt solid black;
}

/* default tab styles */
ul#topmenu a, ul#topmenu span {
    background-color:   #E5E5E5;
    border:             0 solid #D5D5D5;
    border-width:       1pt 1pt 0 1pt;
    -moz-border-radius: 0.4em 0.4em 0 0;
    border-radius:      0.4em 0.4em 0 0;
}

ul#topmenu ul a {
    border-width:       1pt 0 0 0;
    -moz-border-radius: 0;
    border-radius:      0;
}

ul#topmenu ul li:first-child a {
    border-width:       0;
}

/* enabled hover/active tabs */
ul#topmenu > li > a:hover,
ul#topmenu > li > .tabactive {
    margin:             0;
    padding:            2px 4px;
    text-decoration:    none;
}

ul#topmenu ul a:hover,
ul#topmenu ul .tabactive {
    text-decoration:    none;
}

ul#topmenu a.tab:hover,
ul#topmenu .tabactive {
    background-color:   #F5F5F5;
}

ul#topmenu2 a.tab:hover,
ul#topmenu2 a.tabactive {
    background-color:   #E5E5E5;
    -moz-border-radius: 0.3em;
    border-radius:      0.3em;
    text-decoration:    none;
}

/* to be able to cancel the bottom border, use <li class="active"> */
ul#topmenu > li.active {
     border-bottom:      1pt solid #F5F5F5;
}
/* end topmenu */

/* zoom search */
div#dataDisplay input, div#dataDisplay select {
    margin: 0;
    margin-right: 0.5em;
}
div#dataDisplay th {
    line-height: 2em;
}

/* Calendar */
table.calendar {
    width:              100%;
}
table.calendar td {
    text-align:         center;
}
table.calendar td a {
    display:            block;
}

table.calendar td a:hover {
    background-color:   #CCFFCC;
}

table.calendar th {
    background-color:   #D3DCE3;
}

table.calendar td.selected {
    background-color:   #FFCC99;
}

img.calendar {
    border:             none;
}
form.clock {
    text-align:         center;
}
/* end Calendar */


/* table stats */
div#tablestatistics table {
    float: left;
    margin-top: 0.5em;
    margin-bottom: 0.5em;
    margin-right: 0.5em;
    min-width: 16em;
}
/* END table stats */


/* server privileges */
#tableuserrights td,
#tablespecificuserrights td,
#tabledatabases td {
    vertical-align: middle;
}
/* END server privileges */



/* Heading */
#topmenucontainer {
    background: white;
    padding-right: 1em;
    width: 100%;
}

#serverinfo {
    background: white;
    font-weight:        bold;
    padding-bottom: 0.5em;
    width: 10000px;
    overflow: hidden;
}

#serverinfo .item {
    white-space:        nowrap;
}

#goto_pagetop {
    position: fixed;
    padding: .1em .3em;
    top: 0;
    right: 0;
    z-index: 900;
    background: white;
}

#span_table_comment {
    font-weight: bold;
    font-style: italic;
    white-space: nowrap;
    margin-left: 10px;  
    color: #D6D6D6;
    text-shadow: none;
}

#serverinfo img {
    margin:             0 0.1em 0 0.2em;
}


#textSQLDUMP {
    width:              95%;
    height:             95%;
    font-family:        "Courier New", Courier, mono;
    font-size:          110%;
}

#TooltipContainer {
    position:           absolute;
    z-index:            99;
    width:              20em;
    height:             auto;
    overflow:           visible;
    visibility:         hidden;
    background-color:   #ffffcc;
    color:              #006600;
    border:             0.1em solid #000000;
    padding:            0.5em;
}

/* user privileges */
#fieldset_add_user_login div.item {
    border-bottom:      1px solid silver;
    padding-bottom:     0.3em;
    margin-bottom:      0.3em;
}

#fieldset_add_user_login label {
    float:              left;
    display:            block;
    width:              10em;
    max-width:          100%;
    text-align:         right;
    padding-right:      0.5em;
}

#fieldset_add_user_login span.options #select_pred_username,
#fieldset_add_user_login span.options #select_pred_hostname,
#fieldset_add_user_login span.options #select_pred_password {
    width:              100%;
    max-width:          100%;
}

#fieldset_add_user_login span.options {
    float: left;
    display: block;
    width: 12em;
    max-width: 100%;
    padding-right: 0.5em;
}

#fieldset_add_user_login input {
    width: 12em;
    clear: right;
    max-width: 100%;
}

#fieldset_add_user_login span.options input {
    width: auto;
}

#fieldset_user_priv div.item {
    float: left;
    width: 9em;
    max-width: 100%;
}

#fieldset_user_priv div.item div.item {
    float: none;
}

#fieldset_user_priv div.item label {
    white-space: nowrap;
}

#fieldset_user_priv div.item select {
    width: 100%;
}

#fieldset_user_global_rights fieldset {
    float: left;
}

#fieldset_user_group_rights fieldset {
    float: left;
}

#fieldset_user_global_rights legend input {
    margin-left: 2em;
}
/* END user privileges */


/* serverstatus */

.linkElem:hover {
    text-decoration:    underline;
    color:              #235a81;
    cursor: pointer;
}

h3#serverstatusqueries span {
    font-size:60%;
    display:inline;
}

img.sortableIcon {
    float:right;
    background-repeat:no-repeat;
    margin:0;
}

.buttonlinks {
    float: right;
    white-space: nowrap;
}

/* Also used for the variables page */
fieldset#tableFilter {
    margin-bottom:1em;
}

div#serverStatusTabs {
    margin-top:1em;
}

caption a.top {
    float: right;
}

div#serverstatusquerieschart {
    float:left;
    width:500px;
    height:350px;
    padding-left: 30px;
}

div#serverstatus table#serverstatusqueriesdetails {
    float: left;
}

table#serverstatustraffic {
    float: left;
}
table#serverstatusconnections {
    float: left;
    margin-left: 30px;
}

table#serverstatusvariables {
    width: 100%;
    margin-bottom: 1em;
}
table#serverstatusvariables .name {
    width: 18em;
    white-space:nowrap;
}
table#serverstatusvariables .value {
    width: 6em;
}
table#serverstatusconnections {
    float: left;
    margin-left: 30px;
}

div#serverstatus table tbody td.descr a,
div#serverstatus table .tblFooters a {
    white-space: nowrap;
}

div.liveChart {
    clear:both;
    min-width:500px;
    height:400px;
    padding-bottom:80px;
}

#addChartDialog input[type="text"] {
    margin: 0;
    padding:3px;
}

div#chartVariableSettings {
    border:1px solid #ddd;
    background-color:#E6E6E6;
    margin-left:10px;
}

table#chartGrid div.monitorChart {
    background: #EBEBEB;
    width: 400px;
    height: 300px;
}

div#serverstatus div.tabLinks {
    float:left;
    padding-bottom: 10px;
}

.popupContent {
    display: none;
    position: absolute;
    border: 1px solid #CCC;
    margin:0;
    padding:3px;
    -moz-box-shadow:    1px 1px 6px #ddd;
    -webkit-box-shadow: 2px 2px 3px #666;
    box-shadow:         2px 2px 3px #666;
    background-color:white;
    z-index: 2;
}

div#logTable {
    padding-top: 10px;
    clear: both;
}

div#logTable table {
    width:100%;
}

.smallIndent {
    padding-left: 7px;
}

/* end serverstatus */

/* server variables */
#serverVariables {
    min-width: 30em;
}
#serverVariables .var-row > div {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    line-height: 2em;
}

#serverVariables .var-header {
    font-weight:        bold;
    color:              #000000;
    background:         #D3DCE3;
}
#serverVariables .var-header .var-value {
    text-align: left;
}
#serverVariables .var-row {
    padding: 0.5em;
    min-height: 18px;
}
#serverVariables .var-name {
    width: 45%;
    float: left;
    font-weight: bold;
}
#serverVariables .var-name.session {
    font-weight: normal;
    font-style: italic;
}
#serverVariables .var-value {
    width: 50%;
    float: right;
    text-align: right;
}

/* server variables editor */
#serverVariables .editLink {
    padding-right: 1em;
    float: left;
    font-family: sans-serif;
}
#serverVariables .serverVariableEditor {
    width: 100%;
    overflow: hidden;
}
#serverVariables .serverVariableEditor input {
    width: 100%;
    margin: 0 0.5em;
    box-sizing: border-box;
    -ms-box-sizing: border-box;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    height: 2.2em;
}
#serverVariables .serverVariableEditor div {
    display: block;
    overflow: hidden;
    padding-right: 1em;
}
#serverVariables .serverVariableEditor a {
    float: right;
    margin: 0 0.5em;
    line-height: 2em;
}
/* end server variables */

/* querywindow */
body#bodyquerywindow {
    margin: 0;
    padding: 0;
    background-image: none;
    background-color: #F5F5F5;
}

div#querywindowcontainer {
    margin: 0;
    padding: 0;
    width: 100%;
}

div#querywindowcontainer fieldset {
    margin-top: 0;
}
/* END querywindow */

/* profiling */

div#profilingchart {
    width: 550px;
    height: 370px;
    float: left;
}

#profilingchart .jqplot-highlighter-tooltip{
    top: auto !important;
    left: 11px;
    bottom:24px;
}

#profilesummarytable th.header, #profiletable th.header{
    cursor: pointer;
}

#profilesummarytable th.header .sorticon, #profiletable th.header .sorticon{
    width: 16px;
    height: 16px;
    background-repeat: no-repeat;
    background-position: right center;
    display: inline-block;
    vertical-align: middle;
    float: right;
}

#profilesummarytable th.headerSortUp .sorticon, #profiletable th.headerSortUp .sorticon{
    background-image: url(./themes/original/img/s_desc.png);
}

#profilesummarytable th.headerSortDown .sorticon, #profiletable th.headerSortDown .sorticon{
    background-image: url(./themes/original/img/s_asc.png);
}

/* END profiling */

/* querybox */

div#sqlquerycontainer {
    float: left;
    width: 69%;
    /* height: 15em; */
}

div#tablefieldscontainer {
    float: right;
    width: 29%;
    /* height: 15em; */
}

div#tablefieldscontainer select {
    width: 100%;
    /* height: 12em; */
}

textarea#sqlquery {
    width: 100%;
    /* height: 100%; */
}
textarea#sql_query_edit {
    height: 7em;
    width: 95%;
    display: block;
}
div#queryboxcontainer div#bookmarkoptions {
    margin-top: .5em;
}
/* end querybox */

/* main page */
#maincontainer {
    background-image: url(./themes/original/img/logo_right.png);
    background-position: right bottom;
    background-repeat: no-repeat;
}

#mysqlmaininformation,
#pmamaininformation {
    float: left;
    width: 49%;
}

#maincontainer ul {
    list-style-type: disc;
    vertical-align: middle;
}

#maincontainer li {
    margin:  0.2em 0em;
}
/* END main page */

/* iconic view for ul items */

li.no_bullets {
    list-style-type:none !important;
    margin-left: -25px !important;      //align with other list items which have bullets
}

/* END iconic view for ul items */

#body_browse_foreigners {
    background:         #D0DCE0;
    margin: .5em .5em 0 .5em;
}

#bodyquerywindow {
    background:         #D0DCE0;
}

#bodythemes {
    width: 500px;
    margin: auto;
    text-align: center;
}

#bodythemes img {
    border: .1em solid #000;
}

#bodythemes a:hover img {
    border: .1em solid red;
}

#fieldset_select_fields {
    float: left;
}

#selflink {
    clear: both;
    display: block;
    margin-top: 1em;
    margin-bottom: 1em;
    width: 98%;
    margin-left: 1%;
    border-top: .1em solid silver;
    text-align: right;
}

#table_innodb_bufferpool_usage,
#table_innodb_bufferpool_activity {
    float: left;
}

#div_mysql_charset_collations table {
    float: left;
}

.operations_half_width {
    width: 48%;
    float: left;
}
.operations_half_width input[type=text],
.operations_half_width input[type=password],
.operations_half_width input[type=number],
.operations_half_width select {
    width: 95%;
}
.operations_half_width input[type=text].halfWidth,
.operations_half_width input[type=password].halfWidth,
.operations_half_width input[type=number].halfWidth,
.operations_half_width select.halfWidth {
    width: 40%;
}
.operations_half_width ul {
    list-style-type: none;
    padding: 0;
}
.operations_full_width {
    width: 100%;
    clear: both;
}

#qbe_div_table_list {
    float: left;
}

#qbe_div_sql_query {
    float: left;
}

label.desc {
    width: 30em;
    float: left;
}

label.desc sup {
    position: absolute;
}

code.sql,
div.sqlvalidate {
    display:            block;
    padding:            0.3em;
    margin-top:         0;
    margin-bottom:      0;
    max-height:         10em;
    overflow:           auto;
}

#result_query div.sqlOuter,
div.sqlvalidate  {
    border:             #000000 solid 1px;
    border-top:         0;
    border-bottom:      0;
    background:         #E5E5E5;
}

#PMA_slidingMessage code.sql {
    border:             #000000 solid 1px;
    border-top:         0;
    background:         #E5E5E5;
}

#main_pane_left {
    width:              60%;
    float:              left;
    padding-top:        1em;
}

#main_pane_right {
    margin-left: 60%;
    padding-top: 1em;
    padding-left: 1em;
}

.group {
    border-left: 0.3em solid #D3DCE3;
    margin-bottom:      1em;
}

.group h2 {
    background:         #D3DCE3;
    padding:            0.1em 0.3em;
    margin-top:         0;
}

.group-cnt {
    padding: 0 0 0 0.5em;
    display: inline-block;
    width: 98%;
}

textarea#partitiondefinition {
    height:3em;
}


/* for elements that should be revealed only via js */
.hide {
    display:            none;
}

#list_server {
    list-style-image: none;
}

/**
  *  Progress bar styles
  */
div.upload_progress
{
    width: 400px;
    margin: 3em auto;
    text-align: center;
}

div.upload_progress_bar_outer
{
    border: 1px solid #000;
    width: 202px;
    position: relative;
    margin: 0 auto 1em;
    color: #000000;
}

div.upload_progress_bar_inner
{
    background-color: #9999CC;
    width: 0;
    height: 12px;
    margin: 1px;
    overflow: hidden;
    color: #000000;
    position: relative;
}

div.upload_progress_bar_outer div.percentage
{
    position: absolute;
    top: 0;
    left: 0;
    width: 202px;
}

div.upload_progress_bar_inner div.percentage
{
    top: -1px;
    left: -1px;
}

div#statustext {
    margin-top: .5em;
}

table#serverconnection_src_remote,
table#serverconnection_trg_remote,
table#serverconnection_src_local,
table#serverconnection_trg_local  {
  float: left;
}
/**
  *  Validation error message styles
  */
input[type=text].invalid_value,
input[type=password].invalid_value,
input[type=number].invalid_value,
input[type=date].invalid_value,
.invalid_value {
    background: #FFCCCC;
}

/**
  *  Ajax notification styling
  */
 .ajax_notification {
    top: 0;           /** The notification needs to be shown on the top of the page */
    position: fixed;
    margin-top: 0;
    margin-right: auto;
    margin-bottom: 0;
    margin-left: auto;
    padding: 3px 5px;   /** Keep a little space on the sides of the text */
    width: 350px;
    background-color: #FFD700;
    z-index: 1100;      /** If this is not kept at a high z-index, the jQueryUI modal dialogs (z-index:1000) might hide this */
    text-align: center;
    display: block;
    left: 0;
    right: 0;
    background-image: url(./themes/original/img/ajax_clock_small.gif);
    background-repeat: no-repeat;
    background-position: 2%;
 }

 #loading_parent {
    /** Need this parent to properly center the notification division */
    position: relative;
    width: 100%;
 }
/**
  * Export and Import styles
  */

.exportoptions h3, .importoptions h3 {
    border-bottom: 1px #999999 solid;
    font-size: 110%;
}

.exportoptions ul, .importoptions ul, .format_specific_options ul {
    list-style-type: none;
    margin-bottom: 15px;
}

.exportoptions li, .importoptions li {
    margin: 7px;
}
.exportoptions label, .importoptions label, .exportoptions p, .importoptions p {
    margin: 5px;
    float: none;
}

#csv_options label.desc, #ldi_options label.desc, #latex_options label.desc, #output label.desc{
    float: left;
    width: 15em;
}

.exportoptions, .importoptions {
    margin: 20px 30px 30px 10px
}

.format_specific_options h3 {
    margin: 10px 0 0 10px;
    border: 0;
}

.format_specific_options {
    border: 1px solid #999;
    margin: 7px 0;
    padding: 3px;
}

p.desc {
    margin: 5px;
}

/**
  * Export styles only
  */
select#db_select,
select#table_select {
    width: 400px;
}

.export_sub_options {
    margin: 20px 0 0 30px;
}

.export_sub_options h4 {
    border-bottom: 1px #999 solid;
}

.export_sub_options li.subgroup {
    display: inline-block;
    margin-top: 0;
}

.export_sub_options li {
    margin-bottom: 0;
}

#quick_or_custom,
#output_quick_export {
    display: none;
}
/**
 * Import styles only
 */

.importoptions #import_notification {
    margin: 10px 0;
    font-style: italic;
}

input#input_import_file {
    margin: 5px;
}

.formelementrow {
    margin: 5px 0 5px 0;
}

#popup_background {
    display: none;
    position: fixed;
    _position: absolute; /* hack for IE6 */
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background: #000;
    z-index: 1000;
    overflow: hidden;
}

/**
 * Create table styles
 */
#create_table_form table.table-name td {
    vertical-align: middle;
}

/**
 * Table structure styles
 */
#fieldsForm ul.table-structure-actions {
    margin: 0;
    padding: 0;
    list-style: none;
}
#fieldsForm ul.table-structure-actions li {
    float: left;
    margin-right: 0.5em; /* same as padding of "table td" */
}
#fieldsForm ul.table-structure-actions .submenu li {
    padding: 0.3em;
    margin: 0.1em;
}

.margin#change_column_dialog {
    margin: 0 .5em;
}

/**
 * Indexes
 */
#index_frm .index_info input,
#index_frm .index_info select {
    width: 100%;
    box-sizing:         border-box;
    -ms-box-sizing:     border-box;
    -moz-box-sizing:    border-box;
    -webkit-box-sizing: border-box;
}

#index_frm .slider {
    width: 10em;
    margin: .6em;
    float: left;
}

#index_frm .add_fields {
    float: left;
}

#index_frm .add_fields input {
    margin-left: 1em;
}

#index_frm input {
    margin: 0;
}

#index_frm td {
    vertical-align: middle;
}

table#index_columns {
    width: 100%;
}

table#index_columns select {
    width: 100%;
}

#move_columns_dialog div {
    padding: 1em;
}

#move_columns_dialog ul {
    list-style: none;
    margin: 0;
    padding: 0;
}

#move_columns_dialog li {
    background: #D3DCE3;
    border: 1px solid #aaa;
    color: #000000;
    font-weight: bold;
    margin: .4em;
    padding: .2em;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 2px;
}

/* config forms */
.config-form ul.tabs {
    margin:      1.1em 0.2em 0;
    padding:     0 0 0.3em 0;
    list-style:  none;
    font-weight: bold;
}

.config-form ul.tabs li {
    float: left;
}

.config-form ul.tabs li a {
    display:          block;
    margin:           0.1em 0.2em 0;
    padding:          0.1em 0.4em;
    white-space:      nowrap;
    text-decoration:  none;
    border:           1px solid #D5D5D5;
    border-bottom:    none;
}

.config-form ul.tabs li a:hover,
.config-form ul.tabs li a:active,
.config-form ul.tabs li a.active {
    margin:           0;
    padding:          0.1em 0.6em 0.2em;
}

.config-form ul.tabs li.active a {
    background-color: #E5E5E5;
}

.config-form fieldset {
    margin-top:   0;
    padding:      0;
    clear:        both;
    /*border-color: #D5D5D5;*/
}

.config-form legend {
    display: none;
}

.config-form fieldset p {
    margin:    0;
    padding:   0.5em;
    background: #D5D5D5;
}

.config-form fieldset .errors { /* form error list */
    margin:       0 -2px 1em -2px;
    padding: .5em 1.5em;
    background:   #FBEAD9;
    border:       0 #C83838 solid;
    border-width: 1px 0;
    list-style:   none;
    font-family:  sans-serif;
    font-size:    small;
}

.config-form fieldset .inline_errors { /* field error list */
    margin: .3em .3em .3em 0;
    padding:    0;
    list-style: none;
    color:      #9A0000;
    font-size:  small;
}

.config-form fieldset th {
    padding: .3em .3em .3em .5em;
    text-align:     left;
    vertical-align: top;
    width:          40%;
    background:     transparent;
}

.config-form fieldset .doc,
.config-form fieldset .disabled-notice {
    margin-left: 1em;
}

.config-form fieldset .disabled-notice {
    font-size: 80%;
    text-transform: uppercase;
    color: #E00;
    cursor: help;
}

.config-form fieldset td {
    padding-top: .3em;
    padding-bottom: .3em;
    vertical-align: top;
}

.config-form fieldset th small {
    display:     block;
    font-weight: normal;
    font-family: sans-serif;
    font-size:   x-small;
    color:       #444;
}

.config-form fieldset th,
.config-form fieldset td {
    border-top: 1px #D5D5D5 solid;
}

fieldset .group-header th {
    background: #D5D5D5;
}

fieldset .group-header + tr th {
    padding-top: .6em;
}

fieldset .group-field-1 th,
fieldset .group-header-2 th {
    padding-left: 1.5em;
}

fieldset .group-field-2 th,
fieldset .group-header-3 th {
    padding-left: 3em;
}

fieldset .group-field-3 th {
    padding-left: 4.5em;
}

fieldset .disabled-field th,
fieldset .disabled-field th small,
fieldset .disabled-field td {
    color: #666;
    background-color: #ddd;
}

.config-form .lastrow {
    border-top: 1px #000 solid;
}

.config-form .lastrow {
    background: #D3DCE3;
    padding: .5em;
    text-align: center;
}

.config-form .lastrow input {
    font-weight: bold;
}

/* form elements */

.config-form span.checkbox {
    padding: 2px;
    display: inline-block;
}

.config-form .custom { /* customized field */
    background: #FFC;
}

.config-form span.checkbox.custom {
    padding:    1px;
    border:     1px #EDEC90 solid;
    background: #FFC;
}

.config-form .field-error {
    border-color: #A11 !important;
}

.config-form input[type="text"],
.config-form input[type="password"],
.config-form input[type="number"],
.config-form select,
.config-form textarea {
    border: 1px #A7A6AA solid;
    height: auto;
}

.config-form input[type="text"]:focus,
.config-form input[type="password"]:focus,
.config-form input[type="number"]:focus,
.config-form select:focus,
.config-form textarea:focus {
    border:     1px #6676FF solid;
    background: #F7FBFF;
}

.config-form .field-comment-mark {
    font-family: serif;
    color: #007;
    cursor: help;
    padding: 0 0.2em;
    font-weight: bold;
    font-style: italic;
}

.config-form .field-comment-warning {
    color: #A00;
}

/* error list */
.config-form dd {
    margin-left: .5em;
}

.config-form dd:before {
    content: "\25B8  ";
}

.click-hide-message {
    cursor: pointer;
}

.prefsmanage_opts {
    margin-left: 2em;
}

#prefs_autoload {
    margin-bottom: .5em;
}

#placeholder .button {
    position: absolute;
    cursor: pointer;
}

#placeholder div.button {
    font-size: smaller;
    color: #999;
    background-color: #eee;
    padding: 2px;
}

.wrapper {
    float: left;
    margin-bottom: 0.5em;
}
.toggleButton {
    position: relative;
    cursor: pointer;
    font-size: .8em;
    text-align: center;
    line-height: 1.4em;
    height: 1.55em;
    overflow: hidden;
    border-right: .1em solid #888;
    border-left: .1em solid #888;
}
.toggleButton table,
.toggleButton td,
.toggleButton img {
    padding: 0;
    position: relative;
}
.toggleButton .container {
    position: absolute;
}
.toggleButton .toggleOn {
    color: #fff;
    padding: 0 1em;
}
.toggleButton .toggleOff {
    padding: 0 1em;
}

.doubleFieldset fieldset {
    width: 48%;
    float: left;
    padding: 0;
}
.doubleFieldset fieldset.left {
    margin-right: 1%;
}
.doubleFieldset fieldset.right {
    margin-left: 1%;
}
.doubleFieldset legend {
    margin-left: 0.5em;
}
.doubleFieldset div.wrap {
    padding: 0.5em;
}

#table_columns input[type="text"],
#table_columns input[type="password"],
#table_columns input[type="number"],
#table_columns input[type="date"],
#table_columns select {
    width:              10em;
    box-sizing:         border-box;
    -ms-box-sizing:     border-box;
    -moz-box-sizing:    border-box;
    -webkit-box-sizing: border-box;
}

#placeholder {
    position: relative;
    border: 1px solid #aaa;
    float: right;
    overflow: hidden;
}

.placeholderDrag {
    cursor: move;
}

#placeholder .button {
    position: absolute;
}

#left_arrow {
    left: 8px;
    top: 26px;
}

#right_arrow {
    left: 26px;
    top: 26px;
}

#up_arrow {
    left: 17px;
    top: 8px;
}

#down_arrow {
    left: 17px;
    top: 44px;
}

#zoom_in {
    left: 17px;
    top: 67px;
}

#zoom_world {
    left: 17px;
    top: 85px;
}

#zoom_out {
    left: 17px;
    top: 103px;
}

.colborder {
    cursor: col-resize;
    height: 100%;
    margin-left: -5px;
    position: absolute;
    width: 5px;
}

.colborder_active {
    border-right: 2px solid #a44;
}

.pma_table td {
    position: static;
}

.pma_table th.draggable span,
.pma_table tbody td span {
    display: block;
    overflow: hidden;
}

.modal-copy input {
    display: block;
    width: 100%;
    margin-top: 1.5em;
    padding: .3em 0;
}

.cRsz {
    position: absolute;
}

.draggable {
    cursor: move;
}

.cCpy {
    background: #000;
    color: #FFF;
    font-weight: bold;
    margin: 0.1em;
    padding: 0.3em;
    position: absolute;
}

.cPointer {
    background: url(./themes/original/img/col_pointer.png);
    height: 20px;
    margin-left: -5px;  /* must be minus half of its width */
    margin-top: -10px;
    position: absolute;
    width: 10px;
}

.tooltip {
    background: #333 !important;
    opacity: .8 !important;
    border: 1px solid #000 !important;
    -moz-border-radius: .3em !important;
    -webkit-border-radius: .3em !important;
    border-radius: .3em !important;
    text-shadow: -1px -1px #000 !important;
    font-size: .8em !important;
    font-weight: bold !important;
    padding: 1px 3px !important;
}

.tooltip * {
    background: none !important;
    color: #FFF !important;
}


.data_full_width {
    width: 100%;
}

.cDrop {
    left: 0;
    position: absolute;
    top: 0;
}

.coldrop {
    background: url(./themes/original/img/col_drop.png);
    cursor: pointer;
    height: 16px;
    margin-left: 0.5em;
    margin-top: 0.3em;
    position: absolute;
    width: 16px;
}

.coldrop:hover,
.coldrop-hover {
    background-color: #999;
}

.cList {
    background: #EEE;
    border: solid 1px #999;
    position: absolute;
}

.cList .lDiv div {
    padding: .2em .5em .2em .2em;
}

.cList .lDiv div:hover {
    background: #DDD;
    cursor: pointer;
}

.cList .lDiv div input {
    cursor: pointer;
}

.showAllColBtn {
    border-bottom: solid 1px #999;
    border-top: solid 1px #999;
    cursor: pointer;
    font-size: .9em;
    font-weight: bold;
    padding: .35em 1em;
    text-align: center;
}

.showAllColBtn:hover {
    background: #DDD;
}

.navigation {
    background: #E5E5E5;
    border: 1px solid black;
    margin: 0.8em 0;
}

.navigation td {
    margin: 0;
    padding: 0;
    vertical-align: middle;
    white-space: nowrap;
}

.navigation_separator {
    color: #555;
    display: inline-block;
    text-align: center;
    width: 1.2em;
    text-shadow: 1px 0 #FFF;
}

.navigation input[type=submit] {
    background: none;
    border: 0;
    margin: 0;
    padding: 0.3em 0.5em;
    min-width: 1.5em;
    font-weight: bold;
}

.navigation input[type=submit]:hover, .navigation input.edit_mode_active {
    background: #333;
    color: white;
    cursor: pointer;
}

.navigation select {
    margin: 0 .8em;
}

.cEdit {
    margin: 0;
    padding: 0;
    position: absolute;
}

.cEdit input[type=text],
.cEdit input[type=password],
.cEdit input[type=number] {
    background: #FFF;
    height: 100%;
    margin: 0;
    padding: 0;
}

.cEdit .edit_area {
    background: #FFF;
    border: 1px solid #999;
    min-width: 10em;
    padding: .3em .5em;
}

.cEdit .edit_area select,
.cEdit .edit_area textarea {
    width: 97%;
}

.cEdit .cell_edit_hint {
    color: #555;
    font-size: .8em;
    margin: .3em .2em;
}

.cEdit .edit_box {
    overflow: hidden;
    padding: 0;
}

.cEdit .edit_box_posting {
    background: #FFF url(./themes/original/img/ajax_clock_small.gif) no-repeat right center;
    padding-right: 1.5em;
}

.cEdit .edit_area_loading {
    background: #FFF url(./themes/original/img/ajax_clock_small.gif) no-repeat center;
    height: 10em;
}

.cEdit .edit_area_right {
    position: absolute;
    right: 0;
}

.cEdit .goto_link {
    background: #EEE;
    color: #555;
    padding: .2em .3em;
}

.saving_edited_data {
    background: url(./themes/original/img/ajax_clock_small.gif) no-repeat left;
    padding-left: 20px;
}

/* css for timepicker */
.ui-timepicker-div .ui-widget-header { margin-bottom: 8px; }
.ui-timepicker-div dl { text-align: left; }
.ui-timepicker-div dl dt { height: 25px; }
.ui-timepicker-div dl dd { margin: -25px 0 10px 65px; }
.ui-timepicker-div td { font-size: 90%; }

input.btn {
    color: #333;
    background-color: #D0DCE0;
}

body .ui-widget {
    font-size: 1em;
}

.ui-dialog fieldset legend a {
    color: #0000FF;
}

/* jqPlot */

/*rules for the plot target div.  These will be cascaded down to all plot elements according to css rules*/
.jqplot-target {
    position: relative;
    color: #222222;
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    font-size: 1em;
/*    height: 300px;
    width: 400px;*/
}

/*rules applied to all axes*/
.jqplot-axis {
    font-size: 0.75em;
}

.jqplot-xaxis {
    margin-top: 10px;
}

.jqplot-x2axis {
    margin-bottom: 10px;
}

.jqplot-yaxis {
    margin-right: 10px;
}

.jqplot-y2axis, .jqplot-y3axis, .jqplot-y4axis, .jqplot-y5axis, .jqplot-y6axis, .jqplot-y7axis, .jqplot-y8axis, .jqplot-y9axis, .jqplot-yMidAxis {
    margin-left: 10px;
    margin-right: 10px;
}

/*rules applied to all axis tick divs*/
.jqplot-axis-tick, .jqplot-xaxis-tick, .jqplot-yaxis-tick, .jqplot-x2axis-tick, .jqplot-y2axis-tick, .jqplot-y3axis-tick, .jqplot-y4axis-tick, .jqplot-y5axis-tick, .jqplot-y6axis-tick, .jqplot-y7axis-tick, .jqplot-y8axis-tick, .jqplot-y9axis-tick, .jqplot-yMidAxis-tick {
    position: absolute;
    white-space: pre;
}


.jqplot-xaxis-tick {
    top: 0px;
    /* initial position untill tick is drawn in proper place */
    left: 15px;
/*    padding-top: 10px;*/
    vertical-align: top;
}

.jqplot-x2axis-tick {
    bottom: 0px;
    /* initial position untill tick is drawn in proper place */
    left: 15px;
/*    padding-bottom: 10px;*/
    vertical-align: bottom;
}

.jqplot-yaxis-tick {
    right: 0px;
    /* initial position untill tick is drawn in proper place */
    top: 15px;
/*    padding-right: 10px;*/
    text-align: right;
}

.jqplot-yaxis-tick.jqplot-breakTick {
    right: -20px;
    margin-right: 0px;
    padding:1px 5px 1px 5px;
/*  background-color: white;*/
    z-index: 2;
    font-size: 1.5em;
}

.jqplot-y2axis-tick, .jqplot-y3axis-tick, .jqplot-y4axis-tick, .jqplot-y5axis-tick, .jqplot-y6axis-tick, .jqplot-y7axis-tick, .jqplot-y8axis-tick, .jqplot-y9axis-tick {
    left: 0px;
    /* initial position untill tick is drawn in proper place */
    top: 15px;
/*    padding-left: 10px;*/
/*    padding-right: 15px;*/
    text-align: left;
}

.jqplot-yMidAxis-tick {
    text-align: center;
    white-space: nowrap;
}

.jqplot-xaxis-label {
    margin-top: 10px;
    font-size: 11pt;
    position: absolute;
}

.jqplot-x2axis-label {
    margin-bottom: 10px;
    font-size: 11pt;
    position: absolute;
}

.jqplot-yaxis-label {
    margin-right: 10px;
/*    text-align: center;*/
    font-size: 11pt;
    position: absolute;
}

.jqplot-yMidAxis-label {
    font-size: 11pt;
    position: absolute;
}

.jqplot-y2axis-label, .jqplot-y3axis-label, .jqplot-y4axis-label, .jqplot-y5axis-label, .jqplot-y6axis-label, .jqplot-y7axis-label, .jqplot-y8axis-label, .jqplot-y9axis-label {
/*    text-align: center;*/
    font-size: 11pt;
    margin-left: 10px;
    position: absolute;
}

.jqplot-meterGauge-tick {
    font-size: 0.75em;
    color: #999999;
}

.jqplot-meterGauge-label {
    font-size: 1em;
    color: #999999;
}

table.jqplot-table-legend {
    margin-top: 12px;
    margin-bottom: 12px;
    margin-left: 12px;
    margin-right: 12px;
}

table.jqplot-table-legend, table.jqplot-cursor-legend {
    background-color: rgba(255,255,255,0.6);
    border: 1px solid #cccccc;
    position: absolute;
    font-size: 0.75em;
}

td.jqplot-table-legend {
    vertical-align:middle;
}

/*
These rules could be used instead of assigning
element styles and relying on js object properties.
*/

/*
td.jqplot-table-legend-swatch {
    padding-top: 0.5em;
    text-align: center;
}

tr.jqplot-table-legend:first td.jqplot-table-legend-swatch {
    padding-top: 0px;
}
*/

td.jqplot-seriesToggle:hover, td.jqplot-seriesToggle:active {
    cursor: pointer;
}

.jqplot-table-legend .jqplot-series-hidden {
    text-decoration: line-through;
}

div.jqplot-table-legend-swatch-outline {
    border: 1px solid #cccccc;
    padding:1px;
}

div.jqplot-table-legend-swatch {
    width:0px;
    height:0px;
    border-top-width: 5px;
    border-bottom-width: 5px;
    border-left-width: 6px;
    border-right-width: 6px;
    border-top-style: solid;
    border-bottom-style: solid;
    border-left-style: solid;
    border-right-style: solid;
}

.jqplot-title {
    top: 0px;
    left: 0px;
    padding-bottom: 0.5em;
    font-size: 1.2em;
}

table.jqplot-cursor-tooltip {
    border: 1px solid #cccccc;
    font-size: 0.75em;
}


.jqplot-cursor-tooltip {
    border: 1px solid #cccccc;
    font-size: 0.75em;
    white-space: nowrap;
    background: rgba(208,208,208,0.5);
    padding: 1px;
}

.jqplot-highlighter-tooltip, .jqplot-canvasOverlay-tooltip {
    border: 1px solid #cccccc;
    font-size: 0.75em;
    white-space: nowrap;
    background: rgba(208,208,208,0.5);
    padding: 1px;
}

.jqplot-point-label {
    font-size: 0.75em;
    z-index: 2;
}

td.jqplot-cursor-legend-swatch {
    vertical-align: middle;
    text-align: center;
}

div.jqplot-cursor-legend-swatch {
    width: 1.2em;
    height: 0.7em;
}

.jqplot-error {
/*   Styles added to the plot target container when there is an error go here.*/
    text-align: center;
}

.jqplot-error-message {
/*    Styling of the custom error message div goes here.*/
    position: relative;
    top: 46%;
    display: inline-block;
}

div.jqplot-bubble-label {
    font-size: 0.8em;
/*    background: rgba(90%, 90%, 90%, 0.15);*/
    padding-left: 2px;
    padding-right: 2px;
    color: rgb(20%, 20%, 20%);
}

div.jqplot-bubble-label.jqplot-bubble-label-highlight {
    background: rgba(90%, 90%, 90%, 0.7);
}

div.jqplot-noData-container {
    text-align: center;
    background-color: rgba(96%, 96%, 96%, 0.3);
}

#relationalTable select {
    width: 125px;
    margin-right: 5px;
}

.report-data {
    height:13em;
    overflow:scroll;
    width:570px;
    border: solid 1px;
    background: white;
    padding: 2px;
}

.report-description {
    height:10em;
    width:570px;
}

/* FILE: enum_editor.css.php */

/**
 * ENUM/SET editor styles
 */
p.enum_notice {
    margin: 5px 2px;
    font-size: 80%;
}

#enum_editor p {
    margin-top: 0;
    font-style: italic;
}

#enum_editor .values,
#enum_editor .add {
    width: 100%;
}

#enum_editor .add td {
    vertical-align: middle;
    width: 50%;
    padding: 0 0 0;
    padding-left: 1em;
}

#enum_editor .values td.drop {
    width: 1.8em;
    cursor: pointer;
    vertical-align: middle;
}

#enum_editor .values input {
    margin: .1em 0;
    padding-right: 2em;
    width: 100%;
}

#enum_editor .values img {
    width: 1.8em;
    vertical-align: middle;
}

#enum_editor input.add_value {
    margin: 0;
    margin-right: 0.4em;
}

#enum_editor_output textarea {
    width: 100%;
    float: right;
    margin: 1em 0 0 0;
}

/**
 * ENUM/SET editor integration for the routines editor
 */
.enum_hint {
    position: relative;
}

.enum_hint a {
    position: absolute;
    left: 81%;
    bottom: .35em;
}

/* FILE: gis.css.php */

.gis_table td {
    vertical-align: middle;
}

.gis_table select {
    min-width: 151px;
    margin: 6px;
}

.gis_table .button {
   text-align: right;
}

/**
 * GIS data editor styles
 */
a.close_gis_editor {
    float: right;
}

#gis_editor {
    display: none;
    position: fixed;
    _position: absolute; /* hack for IE */
    z-index: 1001;
    overflow-y: auto;
    overflow-x: hidden;
}

#gis_data {
    min-height: 230px;
}

#gis_data_textarea {
    height: 6em;
}

#gis_data_editor {
    background: #D0DCE0;
    padding: 15px;
    min-height: 500px;
}

#gis_data_editor .choice {
    display: none;
}

#gis_data_editor input[type="text"] {
    width: 75px;
}

/* FILE: navigation.css.php */

/******************************************************************************/
/* Navigation */

#pma_navigation {
    background: #D0DCE0;
    color: #000000;
    width: 240px;
    overflow: hidden;
    position: fixed;
    top: 0;
    left: 0;
    height: 100%;
    border-right: 1px solid gray;
    z-index: 800;
}

#pma_navigation_content {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    z-index: 0;
    padding-bottom: 1em;
}

#pma_navigation ul {
    margin: 0;
}

#pma_navigation form {
    margin: 0;
    padding: 0;
    display: inline;
}

#pma_navigation select#select_server,
#pma_navigation select#lightm_db {
    width: 100%;
}

/******************************************************************************/
/* specific elements */

#pma_navigation div.pageselector {
    text-align: center;
    margin: 0 0 0;
    margin-left: 0.75em;
    border-left: 1px solid #666;
}

#pma_navigation div#pmalogo {
        background-color: #D0DCE0;
    padding: .3em;
}

#pma_navigation div#recentTableList {
    text-align: center;
    margin-bottom: 0.5em;
}

#pma_navigation #pmalogo,
#pma_navigation #serverChoice,
#pma_navigation #leftframelinks,
#pma_navigation #recentTableList,
#pma_navigation #databaseList,
#pma_navigation div.pageselector.dbselector {
    text-align:         center;
    margin-bottom:      0.3em;
    padding-bottom:     0.3em;
    border: 0;
}

#pma_navigation #recentTableList select,
#pma_navigation #serverChoice select
 {
    width: 80%;
}

#pma_navigation #recentTableList {
    margin-bottom: 0;
    padding-bottom: 0;
}

#pma_navigation_content > img.throbber {
    display: block;
    margin: 0 auto;
}

/* Navigation tree*/
#pma_navigation_tree {
    margin: 0;
    margin-left: 1em;
    color: #444;
    height: 74%;
    position: relative;
}
#pma_navigation_tree_content {
    width: 100%;
    overflow: hidden;
    overflow-y: auto;
    position: absolute;
    height: 100%;
}
#pma_navigation_tree a {
    color: #000000;
}
#pma_navigation_tree a:hover {
    text-decoration: underline;
}
#pma_navigation_tree li.activePointer {
    color: #000000;
    background-color: #9999CC;
}
#pma_navigation_tree li.selected {
    color: #000000;
    background-color: #9999CC;
}
#pma_navigation_tree li .dbItemControls {
    padding-left: 4px;
}
#pma_navigation_tree li .navItemControls {
    display: none;
    padding-left: 4px;
}
#pma_navigation_tree li.activePointer .navItemControls {
    display: inline;
    opacity: 0.5;
}
#pma_navigation_tree li.activePointer .navItemControls:hover {
    display: inline;
    opacity: 1.0;
}
#pma_navigation_tree ul {
    clear: both;
    padding: 0;
    list-style-type: none;
    margin: 0;
}
#pma_navigation_tree ul ul {
    position: relative;
}
#pma_navigation_tree li {
    white-space: nowrap;
    clear: both;
    min-height: 16px;
}
#pma_navigation_tree img {
    margin: 0;
}
#pma_navigation_tree div.block {
    position: relative;
    width:1.5em;
    height:1.5em;
    min-width: 16px;
    min-height: 16px;
    float: left;
}
#pma_navigation_tree div.block i,
#pma_navigation_tree div.block b {
    width: 1.5em;
    height: 1.5em;
    min-width: 16px;
    min-height: 8px;
    position: absolute;
    bottom: 0.7em;
    left: 0.75em;
    z-index: 0;
}
#pma_navigation_tree div.block i {
    border-left: 1px solid #666;
    border-bottom: 1px solid #666;
}
#pma_navigation_tree div.block i.first { /* Removes top segment */
    border-left: 0;
}
/* Bottom segment for the tree element connections */
#pma_navigation_tree div.block b {
    display: block;
    height: 0.75em;
    bottom: 0;
    left: 0.75em;
    border-left: 1px solid #666;
}
#pma_navigation_tree div.block a,
#pma_navigation_tree div.block u {
    position: absolute;
    left: 50%;
    top: 50%;
    z-index: 10;
}
#pma_navigation_tree div.block img {
    position: relative;
    top: -0.6em;
    left: 0;
    margin-left: -5px;
}
#pma_navigation_tree li.last > ul {
    background: none;
}
#pma_navigation_tree li > a, #pma_navigation_tree li > i {
    line-height: 1.5em;
    height: 1.5em;
    padding-left: 0.3em;
}
#pma_navigation_tree .list_container {
    border-left: 1px solid #666;
    margin-left: 0.75em;
    padding-left: 0.75em;
}
#pma_navigation_tree .last > .list_container {
    border-left: 0 solid #666;
}

/* Fast filter */
li.fast_filter {
    padding-left: 0.75em;
    margin-left: 0.75em;
    padding-right: 35px;
    border-left: 1px solid #666;
}
li.fast_filter input {
    padding-right: 1.7em;
    width: 100%;
}
li.fast_filter span {
    position: relative;
    right: 1.5em;
    padding: 0.2em;
    cursor: pointer;
    font-weight: bold;
    color: #800;
}
/* IE10+ has its own reset X */
html.ie li.fast_filter span {
    display: none;
}
html.ie.ie9 li.fast_filter span,
html.ie.ie8 li.fast_filter span {
    display: auto;
}
html.ie li.fast_filter input {
    padding-right: .2em;
}
html.ie.ie9 li.fast_filter input,
html.ie.ie8 li.fast_filter input {
    padding-right: 1.7em;
}
li.fast_filter.db_fast_filter {
    border: 0;
}

/* Resize handler */
#pma_navigation_resizer {
    width: 3px;
    height: 100%;
    background-color: #aaa;
    cursor: col-resize;
    position: fixed;
    top: 0;
    left: 240px;
    z-index: 801;
}
#pma_navigation_collapser {
    width: 20px;
    height: 22px;
    line-height: 22px;
    background: #eee;
    color: #555;
    font-weight: bold;
    position: fixed;
    top: 0;
    left: 240px;
    text-align: center;
    cursor: pointer;
    z-index: 800;
    text-shadow: 0px 1px 0px #fff;
    filter: dropshadow(color=#fff, offx=0, offy=1);
    border: 1px solid #888;
}

/* FILE: pmd.css.php */

/* Designer */
.input_tab {
    background-color: #A6C7E1;
    color: #000;
}

.content_fullscreen {
    position: relative;
    overflow: auto;
}

#canvas_outer {
    position: relative;
}

#canvas {
    background-color: #fff;
    color: #000;
}

canvas.pmd {
    display: inline-block;
    overflow: hidden;
    text-align: left;
}

canvas.pmd * {
    behavior: url(#default#VML);
}

.pmd_tab {
    background-color: #fff;
    color: #000;
    border-collapse: collapse;
    border: 1px solid #aaa;
    z-index: 1;
    -moz-user-select: none;
}

.tab_zag {
    background-image: url(./themes/pmahomme/img/pmd/Header.png);
    background-repeat: repeat-x;
    text-align: center;
    cursor: move;
    padding: 1px;
    font-weight: bold;
}

.tab_zag_2 {
    background-image: url(./themes/pmahomme/img/pmd/Header_Linked.png);
    background-repeat: repeat-x;
    text-align: center;
    cursor: move;
    padding: 1px;
    font-weight: bold;
}

.tab_field {
    background: #fff;
    color: #000;
    cursor: default;
}

.tab_field_2 {
    background-color: #CCFFCC;
    color: #000;
    background-repeat: repeat-x;
    cursor: default;
}

.tab_field_3 {
    background-color: #FFE6E6; /*#DDEEFF*/
    color: #000;
    cursor: default;
}

#pmd_hint {
    white-space: nowrap;
    position: absolute;
    background-color: #99FF99;
    color: #000;
    left: 200px;
    top: 50px;
    z-index: 3;
    border: #00CC66 solid 1px;
    display: none;
}

.scroll_tab {
    overflow: auto;
    width: 100%;
    height: 500px;
}

.pmd_Tabs {
    cursor: default;
    color: #0055bb;
    white-space: nowrap;
    text-decoration: none;
    text-indent: 3px;
    font-weight: bold;
    margin-left: 2px;
    text-align: left;
    background-color: #fff;
    background-image: url(./themes/pmahomme/img/pmd/left_panel_butt.png);
    border: #ccc solid 1px;
}

.pmd_Tabs2 {
    cursor: default;
    color: #0055bb;
    background: #FFEE99;
    text-indent: 3px;
    font-weight: bold;
    white-space: nowrap;
    text-decoration: none;
    border: #9999FF solid 1px;
    text-align: left;
}

.owner {
    font-weight: normal;
    color: #888;
}

.option_tab {
    padding-left: 2px;
    padding-right: 2px;
    width: 5px;
}

.select_all {
    vertical-align: top;
    padding-left: 2px;
    padding-right: 2px;
    cursor: default;
    width: 1px;
    color: #000;
    background-image: url(./themes/pmahomme/img/pmd/Header.png);
    background-repeat: repeat-x;
}

.small_tab {
    vertical-align: top;
    background-color: #0064ea;
    color: #fff;
    background-image: url(./themes/pmahomme/img/pmd/small_tab.png);
    cursor: default;
    text-align: center;
    font-weight: bold;
    padding-left: 2px;
    padding-right: 2px;
    width: 1px;
    text-decoration: none;
}

.small_tab2 {
    vertical-align: top;
    color: #fff;
    background-color: #FF9966;
    cursor: default;
    padding-left: 2px;
    padding-right: 2px;
    text-align: center;
    font-weight: bold;
    width: 1px;
    text-decoration: none;
}

.small_tab_pref {
    background-image: url(./themes/pmahomme/img/pmd/Header.png);
    background-repeat: repeat-x;
    text-align: center;
    width: 1px;
}

.small_tab_pref2 {
    vertical-align: top;
    color: #fff;
    background-color: #FF9966;
    cursor: default;
    text-align: center;
    font-weight: bold;
    width: 1px;
    text-decoration: none;
}

.butt {
    border: #4477aa solid 1px;
    font-weight: bold;
    height: 19px;
    width: 70px;
    background-color: #fff;
    color: #000;
    vertical-align: baseline;
}

.L_butt2_1 {
    padding: 1px;
    text-decoration: none;
    vertical-align: middle;
    cursor: default;
}

.L_butt2_2 {
    padding: 0;
    border: #0099CC solid 1px;
    background: #FFEE99;
    color: #000;
    text-decoration: none;
    vertical-align: middle;
    cursor: default;
}

/* ---------------------------------------------------------------------------*/
.bor {
    width: 10px;
    height: 10px;
}

.frams1 {
    background: url(./themes/pmahomme/img/pmd/1.png) no-repeat right bottom;
}

.frams2 {
    background: url(./themes/pmahomme/img/pmd/2.png) no-repeat left bottom;
}

.frams3 {
    background: url(./themes/pmahomme/img/pmd/3.png) no-repeat left top;
}

.frams4 {
    background: url(./themes/pmahomme/img/pmd/4.png) no-repeat right top;
}

.frams5 {
    background: url(./themes/pmahomme/img/pmd/5.png) repeat-x center bottom;
}

.frams6 {
    background: url(./themes/pmahomme/img/pmd/6.png) repeat-y left;
}

.frams7 {
    background: url(./themes/pmahomme/img/pmd/7.png) repeat-x top;
}

.frams8 {
    background: url(./themes/pmahomme/img/pmd/8.png) repeat-y right;
}

#osn_tab {
    background-color: #fff;
    color: #000;
    border: #A9A9A9 solid 1px;
}

.pmd_header {
    background-color: #EAEEF0;
    color: #000;
    text-align: center;
    font-weight: bold;
    margin: 0;
    padding: 0;
    background-image: url(./themes/pmahomme/img/pmd/top_panel.png);
    background-position: top;
    background-repeat: repeat-x;
    border-right: #999 solid 1px;
    border-left: #999 solid 1px;
    height: 28px;
    z-index: 101;
    width: 100%;
    position: fixed;
}

.pmd_header a {
    display: block;
    float: left;
    margin: 3px 1px 4px;
    height: 20px;
    border: 1px dotted #fff;
}

.pmd_header .M_bord {
    display: block;
    float: left;
    margin: 4px;
    height: 20px;
    width: 2px;
}

.pmd_header a.first {
    margin-right: 1em;
}

.pmd_header a.last {
    margin-left: 1em;
}

a.M_butt_Selected_down_IE,
a.M_butt_Selected_down {
    border: 1px solid #C0C0BB;
    background-color: #99FF99;
    color: #000;
}

a.M_butt_Selected_down_IE:hover,
a.M_butt_Selected_down:hover,
a.M_butt:hover {
    border: 1px solid #0099CC;
    background-color: #FFEE99;
    color: #000;
}

#layer_menu {
    z-index: 100;
    position: absolute;
    left: 0;
    background-color: #EAEEF0;
    border: #999 solid 1px;
}

#layer_upd_relation {
    position: absolute;
    left: 637px;
    top: 224px;
    z-index: 100;
}

#layer_new_relation {
    position: absolute;
    left: 636px;
    top: 85px;
    z-index: 100;
    width: 153px;
}

#pmd_optionse {
    position: absolute;
    left: 636px;
    top: 85px;
    z-index: 100;
    width: 153px;
}

#layer_menu_sizer {
    background-image: url(./themes/pmahomme/img/pmd/resize.png);
    cursor: nw-resize;
    width: 16px;
    height: 16px;
}

.panel {
    position: fixed;
    top: 60px;
    right: 0;
    display: none;
    background: #FFF;
    border: 1px solid gray;
    width: 350 px;
    height: auto;
    padding: 30px 170px 30px;
    padding-left: 30px;
    color: #FFF;
    z-index: 102;
}

a.trigger {
    position: fixed;
    text-decoration: none;
    top: 60px;
    right: 0;
    color: #fff;
    padding: 10px 40px 10px 15px;
    background: #333 url(./themes/pmahomme/img/pmd/plus.png) 85% 55% no-repeat;
    border: 1px solid #444;
    display: block;
    z-index: 102;
}

a.trigger:hover {
    color: #080808;
    background: #fff696 url(./themes/pmahomme/img/pmd/plus.png) 85% 55% no-repeat;
    border: 1px solid #999;
}

a.active.trigger {
    background: #222 url(./themes/pmahomme/img/pmd/minus.png) 85% 55% no-repeat;
    z-index: 999;
}

a.active.trigger:hover {
    background: #fff696 url(./themes/pmahomme/img/pmd/minus.png) 85% 55% no-repeat;
}

h2.tiger {
    background-repeat: repeat-x;
    padding: 1px;
    font-weight: bold;
    padding: 50px 20px 50px;
    margin: 0 0 5px 0;
    width: 250px;
    float: left;
    color : #333;
    text-align: center;
}

h2.tiger a {
    background-image: url(./themes/pmahomme/img/pmd/Header.png);
    text-align: center;
    text-decoration: none;
    color : #333;
    display: block;
}

h2.tiger a:hover {
    color: #000;
    background-image: url(./themes/pmahomme/img/pmd/Header_Linked.png);
}

h2.active {
    background-image: url(./themes/pmahomme/img/pmd/Header.png);
    background-repeat: repeat-x;
    padding: 1px;
    background-position: left bottom;
}

.toggle_container {
    margin: 0 0 5px;
    padding: 0;
    border-top: 1px solid #d6d6d6;
    background: #FFF;
    width: 250px;
    overflow: hidden;
    font-size: 1.2em;
    clear: both;
}

.toggle_container .block {
    background-color: #DBE4E8;
    padding: 40px 15px 40px 15px; /*--Padding of Container--*/
    border:1px solid #999;
    color: #000;
}

.history_table {
    text-align: center;
    background-color: #9999CC;
}

.history_table2 {
    text-align: center;
    background-color: #DBE4E8;
}

#filter {
    display: none;
    position: absolute;
    top: 0%;
    left: 0%;
    width: 100%;
    height: 100%;
    background-color: #CCA;
    z-index: 10;
    opacity: .5;
    filter: alpha(opacity=50);
}

#box {
    display: none;
    position: absolute;
    top: 20%;
    left: 30%;
    width: 500px;
    height: 220px;
    padding: 48px;
    margin: 0;
    border: 1px solid #000;
    background-color: #fff;
    z-index: 101;
    overflow: visible;
}

#boxtitle {
    position: absolute;
    float: center;
    top: 0;
    left: 0;
    width: 593px;
    height: 20px;
    padding: 0;
    padding-top: 4px;
    margin: 0;
    border-bottom: 4px solid #3CF;
    background-color: #D0DCE0;
    color: black;
    font-weight: bold;
    padding-left: 2px;
    text-align: left;
}

#tblfooter {
    background-color: #D3DCE3;
    float: right;
    padding-top: 10px;
    color: black;
    font-weight: normal;
}

#foreignkeychk {
    text-align: left;
    position: absolute;
    cursor: pointer;
}

/* FILE: rte.css.php */

.rte_table {
    table-layout: fixed;
}

.rte_table td {
    vertical-align: middle;
    padding: 0.2em;
}

.rte_table tr td:nth-child(1) {
    font-weight: bold;
}

.rte_table input,
.rte_table select,
.rte_table textarea {
    width: 100%;
    margin: 0;
    box-sizing: border-box;
    -ms-box-sizing: border-box;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
}

.rte_table .routine_params_table {
    width: 100%;
}

/* FILE: codemirror.css.php */

/* PADDING */

.CodeMirror-lines {
  padding: 4px 0; /* Vertical padding around content */
}
.CodeMirror pre {
  padding: 0 4px; /* Horizontal padding of content */
}

.CodeMirror-scrollbar-filler, .CodeMirror-gutter-filler {
  background-color: white; /* The little square between H and V scrollbars */
}

/* GUTTER */

.CodeMirror-gutters {
  border-right: 1px solid #ddd;
  background-color: #f7f7f7;
  white-space: nowrap;
}
.CodeMirror-linenumbers {}
.CodeMirror-linenumber {
  padding: 0 3px 0 5px;
  min-width: 20px;
  text-align: right;
  color: #999;
}

/* CURSOR */

.CodeMirror div.CodeMirror-cursor {
  border-left: 1px solid black;
  z-index: 3;
}
/* Shown when moving in bi-directional text */
.CodeMirror div.CodeMirror-secondarycursor {
  border-left: 1px solid silver;
}
.CodeMirror.cm-keymap-fat-cursor div.CodeMirror-cursor {
  width: auto;
  border: 0;
  background: #7e7;
  z-index: 1;
}
/* Can style cursor different in overwrite (non-insert) mode */
.CodeMirror div.CodeMirror-cursor.CodeMirror-overwrite {}

.cm-tab { display: inline-block; }

/* DEFAULT THEME */

.cm-s-default .cm-keyword {color: #708;}
.cm-s-default .cm-atom {color: #219;}
.cm-s-default .cm-number {color: #164;}
.cm-s-default .cm-def {color: #00f;}
.cm-s-default .cm-variable {color: black;}
.cm-s-default .cm-variable-2 {color: #05a;}
.cm-s-default .cm-variable-3 {color: #085;}
.cm-s-default .cm-property {color: black;}
.cm-s-default .cm-operator {color: black;}
.cm-s-default .cm-comment {color: #a50;}
.cm-s-default .cm-string {color: #a11;}
.cm-s-default .cm-string-2 {color: #f50;}
.cm-s-default .cm-meta {color: #555;}
.cm-s-default .cm-error {color: #f00;}
.cm-s-default .cm-qualifier {color: #555;}
.cm-s-default .cm-builtin {color: #30a;}
.cm-s-default .cm-bracket {color: #997;}
.cm-s-default .cm-tag {color: #170;}
.cm-s-default .cm-attribute {color: #00c;}
.cm-s-default .cm-header {color: blue;}
.cm-s-default .cm-quote {color: #090;}
.cm-s-default .cm-hr {color: #999;}
.cm-s-default .cm-link {color: #00c;}

.cm-negative {color: #d44;}
.cm-positive {color: #292;}
.cm-header, .cm-strong {font-weight: bold;}
.cm-em {font-style: italic;}
.cm-link {text-decoration: underline;}

.cm-invalidchar {color: #f00;}

div.CodeMirror span.CodeMirror-matchingbracket {color: #0f0;}
div.CodeMirror span.CodeMirror-nonmatchingbracket {color: #f22;}

/* STOP */

/* The rest of this file contains styles related to the mechanics of
   the editor. You probably shouldn't touch them. */

.CodeMirror {
  line-height: 1;
  position: relative;
  overflow: hidden;
  background: white;
  color: black;
  font-family: monospace;
  height: 9em;
}

#inline_editor_outer .CodeMirror {
    height: 3em;
}

.CodeMirror-scroll {
  /* 30px is the magic margin used to hide the element's real scrollbars */
  /* See overflow: hidden in .CodeMirror */
  margin-bottom: -30px; margin-right: -30px;
  padding-bottom: 30px; padding-right: 30px;
  height: 100%;
  outline: none; /* Prevent dragging from highlighting the element */
  position: relative;
}
.CodeMirror-sizer {
  position: relative;
}

/* The fake, visible scrollbars. Used to force redraw during scrolling
   before actuall scrolling happens, thus preventing shaking and
   flickering artifacts. */
.CodeMirror-vscrollbar, .CodeMirror-hscrollbar, .CodeMirror-scrollbar-filler, .CodeMirror-gutter-filler {
  position: absolute;
  z-index: 6;
  display: none;
}
.CodeMirror-vscrollbar {
  right: 0; top: 0;
  overflow-x: hidden;
  overflow-y: scroll;
}
.CodeMirror-hscrollbar {
  bottom: 0; left: 0;
  overflow-y: hidden;
  overflow-x: scroll;
}
.CodeMirror-scrollbar-filler {
  right: 0; bottom: 0;
}
.CodeMirror-gutter-filler {
  left: 0; bottom: 0;
}

.CodeMirror-gutters {
  position: absolute; left: 0; top: 0;
  padding-bottom: 30px;
  z-index: 3;
}
.CodeMirror-gutter {
  white-space: normal;
  height: 100%;
  padding-bottom: 30px;
  margin-bottom: -32px;
  display: inline-block;
  /* Hack to make IE7 behave */
  *zoom:1;
  *display:inline;
}
.CodeMirror-gutter-elt {
  position: absolute;
  cursor: default;
  z-index: 4;
}

.CodeMirror-lines {
  cursor: text;
}
.CodeMirror pre {
  /* Reset some styles that the rest of the page might have set */
  -moz-border-radius: 0; -webkit-border-radius: 0; border-radius: 0;
  border-width: 0;
  background: transparent;
  font-family: inherit;
  font-size: inherit;
  margin: 0;
  white-space: pre;
  word-wrap: normal;
  line-height: inherit;
  color: inherit;
  z-index: 2;
  position: relative;
  overflow: visible;
}
.CodeMirror-wrap pre {
  word-wrap: break-word;
  white-space: pre-wrap;
  word-break: normal;
}
.CodeMirror-code pre {
  border-right: 30px solid transparent;
  width: -webkit-fit-content;
  width: -moz-fit-content;
  width: fit-content;
}
.CodeMirror-wrap .CodeMirror-code pre {
  border-right: none;
  width: auto;
}
.CodeMirror-linebackground {
  position: absolute;
  left: 0; right: 0; top: 0; bottom: 0;
  z-index: 0;
}

.CodeMirror-linewidget {
  position: relative;
  z-index: 2;
  overflow: auto;
}

.CodeMirror-widget {
  display: inline-block;
}

.CodeMirror-wrap .CodeMirror-scroll {
  overflow-x: hidden;
}

.CodeMirror-measure {
  position: absolute;
  width: 100%; height: 0px;
  overflow: hidden;
  visibility: hidden;
}
.CodeMirror-measure pre { position: static; }

.CodeMirror div.CodeMirror-cursor {
  position: absolute;
  visibility: hidden;
  border-right: none;
  width: 0;
}
.CodeMirror-focused div.CodeMirror-cursor {
  visibility: visible;
}

.CodeMirror-selected { background: #d9d9d9; }
.CodeMirror-focused .CodeMirror-selected { background: #d7d4f0; }

.cm-searching {
  background: #ffa;
  background: rgba(255, 255, 0, .4);
}

/* IE7 hack to prevent it from returning funny offsetTops on the spans */
.CodeMirror span { *vertical-align: text-bottom; }

@media print {
  /* Hide the cursor when printing */
  .CodeMirror div.CodeMirror-cursor {
    visibility: hidden;
  }
}

span.cm-keyword, span.cm-statement-verb {
    color: #909;
}
span.cm-variable {
    color: black;
}
span.cm-comment {
    color: #808000;
}
span.cm-mysql-string {
    color: #008000;
}
span.cm-operator {
    color: fuchsia;
}
span.cm-mysql-word {
    color: black;
}
span.cm-builtin {
    color: #f00;
}
span.cm-variable-2 {
    color: #f90;
}
span.cm-variable-3 {
    color: #00f;
}
span.cm-separator {
    color: fuchsia;
}
span.cm-number {
    color: teal;
}

/* FILE: jqplot.css.php */

/* jqPlot */

/*rules for the plot target div.  These will be cascaded down to all plot elements according to css rules*/
.jqplot-target {
    position: relative;
    color: #222222;
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    font-size: 1em;
/*    height: 300px;
    width: 590px;*/
}

/*rules applied to all axes*/
.jqplot-axis {
    font-size: 0.75em;
}

.jqplot-xaxis {
    margin-top: 10px;
}

.jqplot-x2axis {
    margin-bottom: 10px;
}

.jqplot-yaxis {
    margin-right: 10px;
}

.jqplot-y2axis, .jqplot-y3axis, .jqplot-y4axis, .jqplot-y5axis, .jqplot-y6axis, .jqplot-y7axis, .jqplot-y8axis, .jqplot-y9axis, .jqplot-yMidAxis {
    margin-left: 10px;
    margin-right: 10px;
}

/*rules applied to all axis tick divs*/
.jqplot-axis-tick, .jqplot-xaxis-tick, .jqplot-yaxis-tick, .jqplot-x2axis-tick, .jqplot-y2axis-tick, .jqplot-y3axis-tick, .jqplot-y4axis-tick, .jqplot-y5axis-tick, .jqplot-y6axis-tick, .jqplot-y7axis-tick, .jqplot-y8axis-tick, .jqplot-y9axis-tick, .jqplot-yMidAxis-tick {
    position: absolute;
    white-space: pre;
}


.jqplot-xaxis-tick {
    top: 0px;
    /* initial position untill tick is drawn in proper place */
    left: 15px;
/*    padding-top: 10px;*/
    vertical-align: top;
}

.jqplot-x2axis-tick {
    bottom: 0px;
    /* initial position untill tick is drawn in proper place */
    left: 15px;
/*    padding-bottom: 10px;*/
    vertical-align: bottom;
}

.jqplot-yaxis-tick {
    right: 0px;
    /* initial position untill tick is drawn in proper place */
    top: 15px;
/*    padding-right: 10px;*/
    text-align: right;
}

.jqplot-yaxis-tick.jqplot-breakTick {
	right: -20px;
	margin-right: 0px;
	padding:1px 5px 1px;
/*	background-color: white;*/
	z-index: 2;
	font-size: 1.5em;
}

.jqplot-y2axis-tick, .jqplot-y3axis-tick, .jqplot-y4axis-tick, .jqplot-y5axis-tick, .jqplot-y6axis-tick, .jqplot-y7axis-tick, .jqplot-y8axis-tick, .jqplot-y9axis-tick {
    left: 0px;
    /* initial position untill tick is drawn in proper place */
    top: 15px;
/*    padding-left: 10px;*/
/*    padding-right: 15px;*/
    text-align: left;
}

.jqplot-yMidAxis-tick {
    text-align: center;
    white-space: nowrap;
}

.jqplot-xaxis-label {
    margin-top: 10px;
    font-size: 11pt;
    position: absolute;
}

.jqplot-x2axis-label {
    margin-bottom: 10px;
    font-size: 11pt;
    position: absolute;
}

.jqplot-yaxis-label {
    margin-right: 10px;
/*    text-align: center;*/
    font-size: 11pt;
    position: absolute;
}

.jqplot-yMidAxis-label {
    font-size: 11pt;
    position: absolute;
}

.jqplot-y2axis-label, .jqplot-y3axis-label, .jqplot-y4axis-label, .jqplot-y5axis-label, .jqplot-y6axis-label, .jqplot-y7axis-label, .jqplot-y8axis-label, .jqplot-y9axis-label {
/*    text-align: center;*/
    font-size: 11pt;
    margin-left: 10px;
    position: absolute;
}

.jqplot-meterGauge-tick {
    font-size: 0.75em;
    color: #999999;
}

.jqplot-meterGauge-label {
    font-size: 1em;
    color: #999999;
}

table.jqplot-table-legend {
    margin-top: 12px;
    margin-bottom: 12px;
    margin-left: 12px;
    margin-right: 12px;
}

table.jqplot-table-legend, table.jqplot-cursor-legend {
    background-color: rgba(255,255,255,0.6);
    border: 1px solid #cccccc;
    position: absolute;
    font-size: 0.75em;
}

td.jqplot-table-legend {
    vertical-align: middle;
}

/*
These rules could be used instead of assigning
element styles and relying on js object properties.
*/

/*
td.jqplot-table-legend-swatch {
    padding-top: 0.5em;
    text-align: center;
}

tr.jqplot-table-legend:first td.jqplot-table-legend-swatch {
    padding-top: 0px;
}
*/

td.jqplot-seriesToggle:hover, td.jqplot-seriesToggle:active {
    cursor: pointer;
}

.jqplot-table-legend .jqplot-series-hidden {
    text-decoration: line-through;
}

div.jqplot-table-legend-swatch-outline {
    border: 1px solid #cccccc;
    padding: 1px;
}

div.jqplot-table-legend-swatch {
    width: 0;
    height: 0;
    border-top-width: 5px;
    border-bottom-width: 5px;
    border-left-width: 6px;
    border-right-width: 6px;
    border-top-style: solid;
    border-bottom-style: solid;
    border-left-style: solid;
    border-right-style: solid;
}

.jqplot-title {
    top: 0px;
    left: 0px;
    padding-bottom: 0.5em;
    font-size: 1.2em;
}

table.jqplot-cursor-tooltip {
    border: 1px solid #cccccc;
    font-size: 0.75em;
}


.jqplot-cursor-tooltip {
    border: 1px solid #cccccc;
    font-size: 0.75em;
    white-space: nowrap;
    background: rgba(208,208,208,0.5);
    padding: 1px;
}

.jqplot-highlighter-tooltip, .jqplot-canvasOverlay-tooltip {
    border: 1px solid #cccccc;
    font-size: 0.75em;
    white-space: nowrap;
    background: rgba(208,208,208,0.5);
    padding: 1px;
}

.jqplot-point-label {
    font-size: 0.75em;
    z-index: 2;
}

td.jqplot-cursor-legend-swatch {
    vertical-align: middle;
    text-align: center;
}

div.jqplot-cursor-legend-swatch {
    width: 1.2em;
    height: 0.7em;
}

.jqplot-error {
/*   Styles added to the plot target container when there is an error go here.*/
    text-align: center;
}

.jqplot-error-message {
/*    Styling of the custom error message div goes here.*/
    position: relative;
    top: 46%;
    display: inline-block;
}

div.jqplot-bubble-label {
    font-size: 0.8em;
/*    background: rgba(90%, 90%, 90%, 0.15);*/
    padding-left: 2px;
    padding-right: 2px;
    color: rgb(20%, 20%, 20%);
}

div.jqplot-bubble-label.jqplot-bubble-label-highlight {
    background: rgba(90%, 90%, 90%, 0.7);
}

div.jqplot-noData-container {
	text-align: center;
	background-color: rgba(96%, 96%, 96%, 0.3);
}

/* FILE: resizable-menu.css.php */
ul.resizable-menu a,
ul.resizable-menu span {
    display: block;
    margin: 0;
    padding: 0;
    white-space: nowrap;
}

ul.resizable-menu .submenu {
    display: none;
    position: relative;
}

ul.resizable-menu .shown {
    display: inline-block;
}

ul.resizable-menu ul {
    margin: 0;
    padding: 0;
    position: absolute;
    list-style-type: none;
    display: none;
    border: 1px #ddd solid;
    z-index: 2;
    right: 0;
}

ul.resizable-menu li:hover {
    background-image: url(./themes/svg_gradient.php?from=ffffff&to=e5e5e5);
background-size: 100% 100%;
background: -webkit-gradient(linear, left top, left bottom, from(#ffffff), to(#e5e5e5));
background: -webkit-linear-gradient(top, #ffffff, #e5e5e5);
background: -moz-linear-gradient(top, #ffffff, #e5e5e5);
background: -ms-linear-gradient(top, #ffffff, #e5e5e5);
background: -o-linear-gradient(top, #ffffff, #e5e5e5);}

ul.resizable-menu li:hover ul,
ul.resizable-menu .submenuhover ul {
    display: block;
    background: #fff;
}

ul.resizable-menu ul li {
    width: 100%;
}
/* Icon sprites */
.icon {
    margin: 0 .3em;
    padding: 0 !important;
    width: 16px;
    height: 16px;
    background-image: url('./themes/original/img/sprites.png') !important;
    background-repeat: no-repeat !important;
    background-position: top left !important;
}
.ic_b_bookmark { background-position: 0 -16px !important; }
.ic_b_browse { background-position: 0 -32px !important; }
.ic_b_calendar { background-position: 0 -48px !important; }
.ic_b_chart { background-position: 0 -64px !important; }
.ic_b_close { background-position: 0 -80px !important; }
.ic_b_column_add { background-position: 0 -96px !important; }
.ic_b_comment { background-position: 0 -112px !important; }
.ic_b_dbstatistics { background-position: 0 -128px !important; }
.ic_b_deltbl { background-position: 0 -144px !important; }
.ic_b_docs { background-position: 0 -160px !important; }
.ic_b_drop { background-position: 0 -176px !important; }
.ic_b_edit { background-position: 0 -192px !important; }
.ic_b_empty { background-position: 0 -208px !important; }
.ic_b_engine { background-position: 0 -224px !important; }
.ic_b_event_add { background-position: 0 -240px !important; }
.ic_b_events { background-position: 0 -256px !important; }
.ic_b_export { background-position: 0 -272px !important; }
.ic_b_find_replace { background-position: 0 -288px !important; }
.ic_b_ftext { background-position: 0 -304px !important; }
.ic_b_group { background-position: 0 -320px !important; }
.ic_b_help { background-position: 0 -336px !important; width: 11px; height: 11px; }
.ic_b_home { background-position: 0 -352px !important; }
.ic_b_import { background-position: 0 -368px !important; }
.ic_b_index { background-position: 0 -384px !important; }
.ic_b_index_add { background-position: 0 -400px !important; }
.ic_b_info { background-position: 0 -416px !important; width: 11px; height: 11px; }
.ic_b_inline_edit { background-position: 0 -432px !important; }
.ic_b_insrow { background-position: 0 -448px !important; }
.ic_b_minus { background-position: 0 -464px !important; width: 9px; height: 9px; }
.ic_b_more { background-position: 0 -480px !important; }
.ic_b_move { background-position: 0 -496px !important; }
.ic_b_newdb { background-position: 0 -512px !important; }
.ic_b_newtbl { background-position: 0 -528px !important; }
.ic_b_nextpage { background-position: 0 -544px !important; }
.ic_b_plus { background-position: 0 -560px !important; width: 9px; height: 9px; }
.ic_b_primary { background-position: 0 -576px !important; }
.ic_b_print { background-position: 0 -592px !important; }
.ic_b_props { background-position: 0 -608px !important; }
.ic_b_relations { background-position: 0 -624px !important; }
.ic_b_routine_add { background-position: 0 -640px !important; }
.ic_b_routines { background-position: 0 -656px !important; }
.ic_b_save { background-position: 0 -672px !important; }
.ic_b_sbrowse { background-position: 0 -688px !important; width: 10px; height: 10px; }
.ic_b_search { background-position: 0 -704px !important; }
.ic_b_selboard { background-position: 0 -720px !important; }
.ic_b_select { background-position: 0 -736px !important; }
.ic_b_snewtbl { background-position: 0 -752px !important; width: 10px; height: 10px; }
.ic_b_spatial { background-position: 0 -768px !important; }
.ic_b_sql { background-position: 0 -784px !important; }
.ic_b_sqlhelp { background-position: 0 -800px !important; }
.ic_b_table_add { background-position: 0 -816px !important; }
.ic_b_tblanalyse { background-position: 0 -832px !important; }
.ic_b_tblexport { background-position: 0 -848px !important; }
.ic_b_tblimport { background-position: 0 -864px !important; }
.ic_b_tblops { background-position: 0 -880px !important; }
.ic_b_tbloptimize { background-position: 0 -896px !important; }
.ic_b_tipp { background-position: 0 -912px !important; }
.ic_b_trigger_add { background-position: 0 -928px !important; }
.ic_b_triggers { background-position: 0 -944px !important; }
.ic_b_undo { background-position: 0 -960px !important; }
.ic_b_unique { background-position: 0 -976px !important; }
.ic_b_usradd { background-position: 0 -992px !important; }
.ic_b_usrcheck { background-position: 0 -1008px !important; }
.ic_b_usrdrop { background-position: 0 -1024px !important; }
.ic_b_usredit { background-position: 0 -1040px !important; }
.ic_b_usrlist { background-position: 0 -1056px !important; }
.ic_b_view { background-position: 0 -1072px !important; }
.ic_b_view_add { background-position: 0 -1088px !important; }
.ic_b_views { background-position: 0 -1104px !important; }
.ic_bd_browse { background-position: 0 -1120px !important; }
.ic_bd_deltbl { background-position: 0 -1136px !important; }
.ic_bd_drop { background-position: 0 -1152px !important; }
.ic_bd_edit { background-position: 0 -1168px !important; }
.ic_bd_empty { background-position: 0 -1184px !important; }
.ic_bd_export { background-position: 0 -1200px !important; }
.ic_bd_ftext { background-position: 0 -1216px !important; }
.ic_bd_index { background-position: 0 -1232px !important; }
.ic_bd_insrow { background-position: 0 -1248px !important; }
.ic_bd_nextpage { background-position: 0 -1264px !important; width: 8px; height: 13px; }
.ic_bd_primary { background-position: 0 -1280px !important; }
.ic_bd_sbrowse { background-position: 0 -1296px !important; width: 10px; height: 10px; }
.ic_bd_select { background-position: 0 -1312px !important; }
.ic_bd_spatial { background-position: 0 -1328px !important; }
.ic_bd_unique { background-position: 0 -1344px !important; }
.ic_col_drop { background-position: 0 -1360px !important; }
.ic_eye { background-position: 0 -1376px !important; }
.ic_eye_grey { background-position: 0 -1392px !important; }
.ic_lightbulb { background-position: 0 -1408px !important; }
.ic_lightbulb_off { background-position: 0 -1424px !important; }
.ic_more { background-position: 0 -1440px !important; width: 13px; }
.ic_new_data { background-position: 0 -1456px !important; }
.ic_new_data_hovered { background-position: 0 -1472px !important; }
.ic_new_data_selected { background-position: 0 -1488px !important; }
.ic_new_data_selected_hovered { background-position: 0 -1504px !important; }
.ic_new_struct { background-position: 0 -1520px !important; }
.ic_new_struct_hovered { background-position: 0 -1536px !important; }
.ic_new_struct_selected { background-position: 0 -1552px !important; }
.ic_new_struct_selected_hovered { background-position: 0 -1568px !important; }
.ic_pause { background-position: 0 -1584px !important; }
.ic_play { background-position: 0 -1600px !important; }
.ic_s_asc { background-position: 0 -1616px !important; width: 11px; height: 9px; }
.ic_s_asci { background-position: 0 -1632px !important; }
.ic_s_cancel { background-position: 0 -1648px !important; }
.ic_s_cog { background-position: 0 -1664px !important; }
.ic_s_db { background-position: 0 -1680px !important; }
.ic_s_desc { background-position: 0 -1696px !important; width: 11px; height: 9px; }
.ic_s_error { background-position: 0 -1712px !important; }
.ic_s_error2 { background-position: 0 -1728px !important; width: 11px; height: 11px; }
.ic_s_host { background-position: 0 -1744px !important; }
.ic_s_info { background-position: 0 -1760px !important; width: 11px; height: 11px; }
.ic_s_lang { background-position: 0 -1776px !important; }
.ic_s_loggoff { background-position: 0 -1792px !important; }
.ic_s_notice { background-position: 0 -1808px !important; }
.ic_s_passwd { background-position: 0 -1824px !important; }
.ic_s_really { background-position: 0 -1840px !important; width: 11px; height: 11px; }
.ic_s_reload { background-position: 0 -1856px !important; }
.ic_s_replication { background-position: 0 -1872px !important; }
.ic_s_rights { background-position: 0 -1888px !important; }
.ic_s_sortable { background-position: 0 -1904px !important; width: 11px; height: 15px; }
.ic_s_status { background-position: 0 -1920px !important; }
.ic_s_success { background-position: 0 -1936px !important; }
.ic_s_sync { background-position: 0 -1952px !important; }
.ic_s_tbl { background-position: 0 -1968px !important; }
.ic_s_theme { background-position: 0 -1984px !important; }
.ic_s_top { background-position: 0 -2000px !important; }
.ic_s_vars { background-position: 0 -2016px !important; }
.ic_s_views { background-position: 0 -2032px !important; width: 10px; height: 10px; }
.ic_window-new { background-position: 0 -2048px !important; }
img.sortableIcon { background-position: 0 -1904px; height: 15px; width: 11px; }
th.headerSortUp img.sortableIcon { background-position: 0 -1616px; height: 9px; width: 11px; }
th.headerSortDown img.sortableIcon { background-position: 0 -1696px; height: 9px; width: 11px; }
