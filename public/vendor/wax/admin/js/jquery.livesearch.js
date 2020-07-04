/**
 * Perform a live search against a database (as the user types)
 * Author:  Matt McCarty (jQuery Control discovered on jQuery website)
 * Link:    http://jqueryui.com/demos/autocomplete/#combobox
 * 
 * Dependencies: (change source locations to match your directories)
 * ---------------------------------------------------------
 * <link rel="stylesheet" href="http://code.jquery.com/ui/1.8.23/themes/base/jquery-ui.css" type="text/css" media="all" />
 * <link rel="stylesheet" href="http://static.jquery.com/ui/css/demo-docs-theme/ui.theme.css" type="text/css" media="all" />
 * <script src="http://code.jquery.com/ui/1.8.23/jquery-ui.min.js"type="text/javascript"></script>
 * <script type="text/javascript" src="../vendor/wax/admin/js/jquery.livesearch.js"></script>
 * 
 * HTML:
 * ---------------------------------------------------------
 * <select id="combobox" name="add_any_name_here"></select>
 *
 *
 * Backend (PHP code)
 * ---------------------------------------------------------
 * if ($_SERVER ["REQUEST_METHOD"] === "POST") {
    if (isset ( $_REQUEST ["call"] ) && isset ( $_REQUEST ["val"] )) {
        $call   = request ( "call", false );
        $val    = request ( "val", false );
        if ($call === "livesearch" && $val !== false) {
            $sql =  "SELECT * FROM `my_table` WHERE `my_column` LIKE '%{$val}%'";
            $query = @Db::query ( $sql );
            $ret = array ();
            $html = "";
            while ( $res = @Db::fetch_assoc ( $query ) ) {
                $ret [] = $res;
                $html .= '<option value="' . $res ["id"] . '">' . $res ["first_name"] . ' ' . $res ["last_name"] . " ({$res["email"]})" . ' with ' . $res ["name"] . '</option>';
            }
            
            if (! is_array ( $ret ) || empty ( $ret )) {
                die ( '<option value="">No Results Found</option>' );
            } else {
                if (strlen ( $html )) {
                    $html = '<option value="">Select one...</option>' . $html;
                }
                die ( $html );
            }
        }
    }
}
 * 
 */
(function( $ ) {
    
    
    // This is the back end script that will handle your search request. Change as needed
    var script = '/admin/cms_multiselect_popup.php';
    
    
    
    $.widget( "ui.combobox", {
        _create: function() {
            var input,
            self        = this,
            select      = this.element.hide(),
            selected    = select.children( ":selected" ),
            value       = selected.val() ? selected.text() : "",
                            wrapper = this.wrapper = $( "<span>" )
                                            .addClass( "ui-combobox" )
                                            .insertAfter( select );
            haschanged  = false;

            input = $( "<input>" )
            .mousedown(function() {
                if (this.value.length > 0) {
                    this.haschanged = false;
                    $(this).attr("placeholder", this.value)
                    this.value = "";
                }
                $(this).css('background', 'white');
            })
            .blur(function() {
                if (this.haschanged === false) {
                    this.value = $(this).attr("placeholder");
                }
                $(this).css('background', '#dddddd');
            })
            .appendTo( wrapper )
            .val( value )
            .addClass( "ui-state-default ui-combobox-input" )
            .autocomplete({
                delay: 0,
                minLength: 0,
                source: function( request, response ) {
                    var val = request.term;
                    $.post(script, { 'call':'livesearch', 'val':val }, function(data) {
                        select.html(data);
                        var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
                        response( select.children( "option" ).map(function() {
                            var text = $( this ).text();
                            if ( this.value && ( !request.term || matcher.test(text) ) )
                                return {
                                label: text.replace(
                                        new RegExp(
                                                "(?![^&;]+;)(?!<[^<>]*)(" +
                                                $.ui.autocomplete.escapeRegex(request.term) +
                                                ")(?![^<>]*>)(?![^&;]+;)", "gi"
                                        ), "<strong>$1</strong>" ),
                                        value: text,
                                        option: this
                            };
                        }) );
                    });
                },
                select: function( event, ui ) {
                    ui.item.option.selected = true;
                    this.haschanged = true;
                    self._trigger( "selected", event, {
                        item: ui.item.option
                    });
                },
                change: function( event, ui ) {
                    select.html(data);
                    if ( !ui.item ) {
                        var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( $(this).val() ) + "$", "i" ),
                        valid = false;
                        select.children( "option" ).each(function() {
                            if ( $( this ).text().match( matcher ) ) {
                                this.selected = valid = true;
                                return false;
                            }
                        });
                        if ( !valid ) {
                            // remove invalid value, as it didn't match anything
                            $( this ).val( "" );
                            select.val( "" );
                            input.data( "autocomplete" ).term = "";
                            return false;
                        }
                    }               

                },
            })
            .addClass( "ui-widget ui-widget-content ui-corner-left" );

            input.data( "autocomplete" )._renderItem = function( ul, item ) {
                return $( "<li></li>" )
                .data( "item.autocomplete", item )
                .append( "<a>" + item.label + "</a>" )
                .appendTo( ul );
            };

            $( "<a>" )
            .attr( "tabIndex", -1 )
            .attr( "title", "Show All Items" )
            .appendTo( wrapper )
            .button({
                icons: {
                    primary: "ui-icon-triangle-1-s"
                },
                text: false
            })
            .removeClass( "ui-corner-all" )
            .addClass( "ui-corner-right ui-combobox-toggle" )
            .click(function() {
                // close if already visible
                if ( input.autocomplete( "widget" ).is( ":visible" ) ) {
                    input.autocomplete( "close" );
                    return;
                }

                // work around a bug (likely same cause as #5265)
                $( this ).blur();

                // pass empty string as value to search for, displaying all results
                input.autocomplete( "search", "" );
                input.focus();
            });
        },
        destroy: function() {
            this.wrapper.remove();
            this.element.show();
            $.Widget.prototype.destroy.call( this );
        }
    });
})( jQuery );


$(function() {
    $( "#livesearch, .livesearch_control" ).combobox();
    $( "#toggle").click(function() {
        $( "#livesearch, .livesearch_control" ).toggle();
    });
});