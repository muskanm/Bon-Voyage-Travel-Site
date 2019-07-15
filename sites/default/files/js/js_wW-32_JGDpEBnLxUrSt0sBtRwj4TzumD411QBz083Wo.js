
/**
 *  @file
 *  Javascript to enhance the views slideshow cycle form options.
 */

/**
 * This will set our initial behavior, by starting up each individual slideshow.
 */
(function ($) {
  
  // Since Drupal 7 doesn't support having a field based on one of 3 values of
  // a select box we need to add our own JavaScript handling.
  Drupal.behaviors.viewsSlideshowCycleAmountAllowedVisible = {
    attach: function (context) {
      
      // If necessary at start hide the amount allowed visible box.
      var type = $(":input[name='style_options[views_slideshow_cycle][pause_when_hidden_type]']").val();
      if (type == 'full') {
        $(":input[name='style_options[views_slideshow_cycle][amount_allowed_visible]']").parent().hide();
      }
      
      // Handle dependency on action advanced checkbox.
      $(":input[name='style_options[views_slideshow_cycle][action_advanced]']").change(function() {
        processValues('action_advanced');
      });
      
      // Handle dependency on pause when hidden checkbox.
      $(':input[name="style_options[views_slideshow_cycle][pause_when_hidden]"]').change(function() {
        processValues('pause_when_hidden');
      });
      
      // Handle dependency on pause when hidden type select box.
      $(":input[name='style_options[views_slideshow_cycle][pause_when_hidden_type]']").change(function() {
        processValues('pause_when_hidden_type');
      });
      
      // Process our dependencies.
      function processValues(field) {
        switch (field) {
          case 'action_advanced':
            if (!$(':input[name="style_options[views_slideshow_cycle][action_advanced]"]').is(':checked')) {
              $(":input[name='style_options[views_slideshow_cycle][amount_allowed_visible]']").parent().hide();
              break;
            }
          case 'pause_when_hidden':
            if (!$(':input[name="style_options[views_slideshow_cycle][pause_when_hidden]"]').is(':checked')) {
              $(":input[name='style_options[views_slideshow_cycle][amount_allowed_visible]']").parent().hide();
              break;
            }
          case 'pause_when_hidden_type':
            if ($(":input[name='style_options[views_slideshow_cycle][pause_when_hidden_type]']").val() == 'full') {
              $(":input[name='style_options[views_slideshow_cycle][amount_allowed_visible]']").parent().hide();
            }
            else {
              $(":input[name='style_options[views_slideshow_cycle][amount_allowed_visible]']").parent().show();
            }
        }
      }
    }
  }
  
  // Manage advanced options 
  Drupal.behaviors.viewsSlideshowCycleOptions = {
    attach: function (context) {
      if ($(":input[name='style_options[views_slideshow_cycle][advanced_options]']").length) {
        $(":input[name='style_options[views_slideshow_cycle][advanced_options]']").parent().hide();
        
        $(":input[name='style_options[views_slideshow_cycle][advanced_options_entry]']").parent().after(
          '<div style="margin-left: 10px; padding: 10px 0;">' + 
            '<a id="edit-style-options-views-slideshow-cycle-advanced-options-update-link" href="#">' + Drupal.t('Update Advanced Option') + '</a>' +
          '</div>'
        );
        
        $("#edit-style-options-views-slideshow-cycle-advanced-options-table").append('<tr><th colspan="2">' + Drupal.t('Applied Options') + '</th><tr>')
        
        var initialValue = $(":input[name='style_options[views_slideshow_cycle][advanced_options]']").val();
        var advancedOptions = JSON.parse(initialValue);
        for (var option in advancedOptions) {
          viewsSlideshowCycleAdvancedOptionsAddRow(option);
        }
        
        // Add the remove event to the advanced items.
        viewsSlideshowCycleAdvancedOptionsRemoveEvent();
        
        $(":input[name='style_options[views_slideshow_cycle][advanced_options_choices]']").change(function() {
          var selectedValue = $(":input[name='style_options[views_slideshow_cycle][advanced_options_choices]'] option:selected").val();
          if (typeof advancedOptions[selectedValue] !== 'undefined') {
            $(":input[name='style_options[views_slideshow_cycle][advanced_options_entry]']").val(advancedOptions[selectedValue]);
          }
          else {
            $(":input[name='style_options[views_slideshow_cycle][advanced_options_entry]']").val('');
          }
        });
    
        $('#edit-style-options-views-slideshow-cycle-advanced-options-update-link').click(function() {
          var option = $(":input[name='style_options[views_slideshow_cycle][advanced_options_choices]']").val();
          if (option) {
            var value = $(":input[name='style_options[views_slideshow_cycle][advanced_options_entry]']").val();
          
            if (typeof advancedOptions[option] == 'undefined') {
              viewsSlideshowCycleAdvancedOptionsAddRow(option);
              viewsSlideshowCycleAdvancedOptionsRemoveEvent()
            }
            advancedOptions[option] = value;
            viewsSlideshowCycleAdvancedOptionsSave();
          }
          
          return false;
        });
      }
      
      function viewsSlideshowCycleAdvancedOptionsAddRow(option) {
        $("#edit-style-options-views-slideshow-cycle-advanced-options-table").append(
          '<tr id="views-slideshow-cycle-advanced-options-table-row-' + option + '">' +
            '<td>' + option + '</td>' +
            '<td style="width: 20px;">' +
              '<a style="margin-top: 6px" title="Remove ' + option + '" alt="Remove ' + option + '" class="views-hidden views-button-remove views-slideshow-cycle-advanced-options-table-remove" id="views-slideshow-cycle-advanced-options-table-remove-' + option + '" href="#"><span>Remove</span></a>' +
            '</td>' +
          '</tr>'
        );
      }
      
      function viewsSlideshowCycleAdvancedOptionsRemoveEvent() {
        $('.views-slideshow-cycle-advanced-options-table-remove').unbind().click(function() {
          var itemID = $(this).attr('id');
          var uniqueID = itemID.replace('views-slideshow-cycle-advanced-options-table-remove-', '');
          delete advancedOptions[uniqueID];
          $('#views-slideshow-cycle-advanced-options-table-row-' + uniqueID).remove();
          viewsSlideshowCycleAdvancedOptionsSave();
          return false;
        });
      }
      
      function viewsSlideshowCycleAdvancedOptionsSave() {
        var advancedOptionsString = JSON.stringify(advancedOptions);
        $(":input[name='style_options[views_slideshow_cycle][advanced_options]']").val(advancedOptionsString);
      }
    }
  }
})(jQuery, Drupal);
;
/**
* DO NOT EDIT THIS FILE.
* See the following change record for more information,
* https://www.drupal.org/node/2815083
* @preserve
**/

(function ($, Drupal, drupalSettings) {
  drupalSettings.dialog = {
    autoOpen: true,
    dialogClass: '',

    buttonClass: 'button',
    buttonPrimaryClass: 'button--primary',
    close: function close(event) {
      Drupal.dialog(event.target).close();
      Drupal.detachBehaviors(event.target, null, 'unload');
    }
  };

  Drupal.dialog = function (element, options) {
    var undef = void 0;
    var $element = $(element);
    var dialog = {
      open: false,
      returnValue: undef
    };

    function openDialog(settings) {
      settings = $.extend({}, drupalSettings.dialog, options, settings);

      $(window).trigger('dialog:beforecreate', [dialog, $element, settings]);
      $element.dialog(settings);
      dialog.open = true;
      $(window).trigger('dialog:aftercreate', [dialog, $element, settings]);
    }

    function closeDialog(value) {
      $(window).trigger('dialog:beforeclose', [dialog, $element]);
      $element.dialog('close');
      dialog.returnValue = value;
      dialog.open = false;
      $(window).trigger('dialog:afterclose', [dialog, $element]);
    }

    dialog.show = function () {
      openDialog({ modal: false });
    };
    dialog.showModal = function () {
      openDialog({ modal: true });
    };
    dialog.close = closeDialog;

    return dialog;
  };
})(jQuery, Drupal, drupalSettings);;
/**
* DO NOT EDIT THIS FILE.
* See the following change record for more information,
* https://www.drupal.org/node/2815083
* @preserve
**/

(function ($, Drupal, drupalSettings, debounce, displace) {
  drupalSettings.dialog = $.extend({ autoResize: true, maxHeight: '95%' }, drupalSettings.dialog);

  function resetPosition(options) {
    var offsets = displace.offsets;
    var left = offsets.left - offsets.right;
    var top = offsets.top - offsets.bottom;

    var leftString = (left > 0 ? '+' : '-') + Math.abs(Math.round(left / 2)) + 'px';
    var topString = (top > 0 ? '+' : '-') + Math.abs(Math.round(top / 2)) + 'px';
    options.position = {
      my: 'center' + (left !== 0 ? leftString : '') + ' center' + (top !== 0 ? topString : ''),
      of: window
    };
    return options;
  }

  function resetSize(event) {
    var positionOptions = ['width', 'height', 'minWidth', 'minHeight', 'maxHeight', 'maxWidth', 'position'];
    var adjustedOptions = {};
    var windowHeight = $(window).height();
    var option = void 0;
    var optionValue = void 0;
    var adjustedValue = void 0;
    for (var n = 0; n < positionOptions.length; n++) {
      option = positionOptions[n];
      optionValue = event.data.settings[option];
      if (optionValue) {
        if (typeof optionValue === 'string' && /%$/.test(optionValue) && /height/i.test(option)) {
          windowHeight -= displace.offsets.top + displace.offsets.bottom;
          adjustedValue = parseInt(0.01 * parseInt(optionValue, 10) * windowHeight, 10);

          if (option === 'height' && event.data.$element.parent().outerHeight() < adjustedValue) {
            adjustedValue = 'auto';
          }
          adjustedOptions[option] = adjustedValue;
        }
      }
    }

    if (!event.data.settings.modal) {
      adjustedOptions = resetPosition(adjustedOptions);
    }
    event.data.$element.dialog('option', adjustedOptions).trigger('dialogContentResize');
  }

  $(window).on({
    'dialog:aftercreate': function dialogAftercreate(event, dialog, $element, settings) {
      var autoResize = debounce(resetSize, 20);
      var eventData = { settings: settings, $element: $element };
      if (settings.autoResize === true || settings.autoResize === 'true') {
        $element.dialog('option', { resizable: false, draggable: false }).dialog('widget').css('position', 'fixed');
        $(window).on('resize.dialogResize scroll.dialogResize', eventData, autoResize).trigger('resize.dialogResize');
        $(document).on('drupalViewportOffsetChange.dialogResize', eventData, autoResize);
      }
    },
    'dialog:beforeclose': function dialogBeforeclose(event, dialog, $element) {
      $(window).off('.dialogResize');
      $(document).off('.dialogResize');
    }
  });
})(jQuery, Drupal, drupalSettings, Drupal.debounce, Drupal.displace);;
/**
* DO NOT EDIT THIS FILE.
* See the following change record for more information,
* https://www.drupal.org/node/2815083
* @preserve
**/

(function ($) {
  $.widget('ui.dialog', $.ui.dialog, {
    options: {
      buttonClass: 'button',
      buttonPrimaryClass: 'button--primary'
    },
    _createButtons: function _createButtons() {
      var opts = this.options;
      var primaryIndex = void 0;
      var index = void 0;
      var il = opts.buttons.length;
      for (index = 0; index < il; index++) {
        if (opts.buttons[index].primary && opts.buttons[index].primary === true) {
          primaryIndex = index;
          delete opts.buttons[index].primary;
          break;
        }
      }
      this._super();
      var $buttons = this.uiButtonSet.children().addClass(opts.buttonClass);
      if (typeof primaryIndex !== 'undefined') {
        $buttons.eq(index).addClass(opts.buttonPrimaryClass);
      }
    }
  });
})(jQuery);;
/**
* DO NOT EDIT THIS FILE.
* See the following change record for more information,
* https://www.drupal.org/node/2815083
* @preserve
**/

(function ($, Drupal) {
  Drupal.behaviors.dialog = {
    attach: function attach(context, settings) {
      var $context = $(context);

      if (!$('#drupal-modal').length) {
        $('<div id="drupal-modal" class="ui-front"/>').hide().appendTo('body');
      }

      var $dialog = $context.closest('.ui-dialog-content');
      if ($dialog.length) {
        if ($dialog.dialog('option', 'drupalAutoButtons')) {
          $dialog.trigger('dialogButtonsChange');
        }

        $dialog.dialog('widget').trigger('focus');
      }

      var originalClose = settings.dialog.close;

      settings.dialog.close = function (event) {
        for (var _len = arguments.length, args = Array(_len > 1 ? _len - 1 : 0), _key = 1; _key < _len; _key++) {
          args[_key - 1] = arguments[_key];
        }

        originalClose.apply(settings.dialog, [event].concat(args));
        $(event.target).remove();
      };
    },
    prepareDialogButtons: function prepareDialogButtons($dialog) {
      var buttons = [];
      var $buttons = $dialog.find('.form-actions input[type=submit], .form-actions a.button');
      $buttons.each(function () {
        var $originalButton = $(this).css({
          display: 'block',
          width: 0,
          height: 0,
          padding: 0,
          border: 0,
          overflow: 'hidden'
        });
        buttons.push({
          text: $originalButton.html() || $originalButton.attr('value'),
          class: $originalButton.attr('class'),
          click: function click(e) {
            if ($originalButton.is('a')) {
              $originalButton[0].click();
            } else {
              $originalButton.trigger('mousedown').trigger('mouseup').trigger('click');
              e.preventDefault();
            }
          }
        });
      });
      return buttons;
    }
  };

  Drupal.AjaxCommands.prototype.openDialog = function (ajax, response, status) {
    if (!response.selector) {
      return false;
    }
    var $dialog = $(response.selector);
    if (!$dialog.length) {
      $dialog = $('<div id="' + response.selector.replace(/^#/, '') + '" class="ui-front"/>').appendTo('body');
    }

    if (!ajax.wrapper) {
      ajax.wrapper = $dialog.attr('id');
    }

    response.command = 'insert';
    response.method = 'html';
    ajax.commands.insert(ajax, response, status);

    if (!response.dialogOptions.buttons) {
      response.dialogOptions.drupalAutoButtons = true;
      response.dialogOptions.buttons = Drupal.behaviors.dialog.prepareDialogButtons($dialog);
    }

    $dialog.on('dialogButtonsChange', function () {
      var buttons = Drupal.behaviors.dialog.prepareDialogButtons($dialog);
      $dialog.dialog('option', 'buttons', buttons);
    });

    response.dialogOptions = response.dialogOptions || {};
    var dialog = Drupal.dialog($dialog.get(0), response.dialogOptions);
    if (response.dialogOptions.modal) {
      dialog.showModal();
    } else {
      dialog.show();
    }

    $dialog.parent().find('.ui-dialog-buttonset').addClass('form-actions');
  };

  Drupal.AjaxCommands.prototype.closeDialog = function (ajax, response, status) {
    var $dialog = $(response.selector);
    if ($dialog.length) {
      Drupal.dialog($dialog.get(0)).close();
      if (!response.persist) {
        $dialog.remove();
      }
    }

    $dialog.off('dialogButtonsChange');
  };

  Drupal.AjaxCommands.prototype.setDialogOption = function (ajax, response, status) {
    var $dialog = $(response.selector);
    if ($dialog.length) {
      $dialog.dialog('option', response.optionName, response.optionValue);
    }
  };

  $(window).on('dialog:aftercreate', function (e, dialog, $element, settings) {
    $element.on('click.dialog', '.dialog-cancel', function (e) {
      dialog.close('cancel');
      e.preventDefault();
      e.stopPropagation();
    });
  });

  $(window).on('dialog:beforeclose', function (e, dialog, $element) {
    $element.off('.dialog');
  });
})(jQuery, Drupal);;
