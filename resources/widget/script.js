define( [ 'jquery', 'underscore', 'twigjs', 'lib/components/base/modal' ], function ( $, _, Twig, Modal ) {
  let CustomWidget = function () {
    let self = this;

    this.config = {
      isDev : true,
      baseUrl: 'https://hub.integrat.pro/Murad/amodashboard/public/api',
      name: 'amoDashboard',
      widgetPrefix : 'amodashboard'
    },

    this.dataStorage = {
      currentModal : null,
      reportSetInterval : 60000,
      blockReportSetInterval : 300000,
      blockReportIntervalId : null,
      allowReport : true
    },

    this.selectors = {
      js : {},
    },

    this.getters = {},

    this.setters = {},

    this.baseHtml = {},

    this.renderers = {

      /**
       * Method for generating and rendering the .twig template
       * 
       * @public
       * 
       * @param {str} template - the name of the .twig template
       * @param {obj} params - template settings. The format is:
       * {
       *    widgetPrefix : self.config.widgetPrefix,
       *    ...
       * }
       * 
       * @param {obj} callback - callback settings. The format is:
       * {
       *    exec : function ( param_1.val, param_2.val, ..., param_n.val ) {},
       *    params : {
       *      param_1 : val,
       *      param_2 : val,
       *      ...
       *      param_n : val,
       *    }
       * }
       * 
       * @returns
       */
      render : function ( template, params, callback ) {
        params = ( typeof params == 'object' ) ? params : {};
        template = template || '';

        return self.render(
          {
            href: '/templates/' + template + '.twig',
            base_path: self.params.path,
            v: self.get_version(),
            load: ( template ) => {
              let html = template.render( { data: params } );

              callback.params ? callback.exec( html, callback.params ) : callback.exec( html );
            }
          },

          params
        );
      },

      /**
       * Example of render method .twig template
       * 
       * @param {str} selector 
       * @param {obj} data 
       * @param {str} location 
       */
      render__etwas : function ( selector, data = null, location = 'append' ) {
        let render__etwasData = {
          widgetPrefix : self.config.widgetPrefix
        };

        self.renderers.render( 'etwas', render__etwasData, ( html ) => {
          $( selector )[ location ]( html );
        } );
      },

      modalWindow: {
        show: function ( html, modalParams, callback = false, callbackParams = {} ) {
          self.dataStorage.flags.modalEvent = true;

          self.dataStorage.currentModal = new Modal (
            {
              class_name: "modal-window",

              init: function( $modal_body ) {
                self.currentModal = $( this );

                console.debug( '$modal_body:' );
                console.debug( self.currentModal );

                modalParams.sizeParams.width ? $modal_body.css( 'width', modalParams.sizeParams.width ) : $modal_body.css( 'width', 'auto' );
                modalParams.sizeParams.height ? $modal_body.css( 'height', modalParams.sizeParams.height ) : $modal_body.css( 'height', 'auto' );

                $modal_body.css( 'margin-top', '-590px' );
                $modal_body.css( 'margin-left', '-470px' );

                $modal_body
                  .append( html )
                  .trigger( 'modal:loaded' );

                if ( callback )
                {
                  callback();
                }
              },

              destroy: function () {
                console.debug( "close modal-destroy" ); // Debug

                self.dataStorage.flags.modalEvent = false;

                return true;
              }
            }
          );
        },

        setData: function ( data ) {
          $( 'div.modal-body__inner__todo-types' ).append( data );
        },

        destroy: function () {
          self.dataStorage.currentModal.destroy();
        }
      },
    },

    this.handlers = {
      globalOnmousemove : function ( event ) {
        self.helpers.debug( self.config.name + " << [handler] : globalOnmousemove" );

        self.dataStorage.allowReport = true;
        self.helpers.updateVlockReportInterval();
      },

      globalOnkeydown : function ( event ) {
        self.helpers.debug( self.config.name + " << [handler] : globalOnkeydown" );

        self.dataStorage.allowReport = true;
        self.helpers.updateVlockReportInterval();
      }
    },

    this.actions = {
      report : function () {
        self.helpers.debug( self.config.name + " << [action] : report" );

        if ( self.dataStorage.allowReport )
        {
          $.post(
            self.config.baseUrl + '/hook/usagetime',

            {
              'user_id' : AMOCRM.constant( 'user' ).id
            }
          ).fail(
            () => {
              console.error( "amodashboard << report: error" );
            }
          );
        }
      },

      blockReport : function () {
        self.helpers.debug( self.config.name + " << [action] : blockReport" );

        self.dataStorage.allowReport = false;
      }
    },

    this.helpers = {
      debug : function ( text ) {
        if ( self.config.isDev ) console.debug( text );
      },

      updateVlockReportInterval : function () {
        self.helpers.debug( self.config.name + " << [helper] : updateVlockReportInterval" );

        clearInterval( self.dataStorage.blockReportIntervalId );

        self.dataStorage.blockReportIntervalId = setInterval(
          self.actions.blockReport,
          self.dataStorage.blockReportSetInterval
        );
      }
    },

    this.callbacks = {
      render: function () {
        self.helpers.debug( self.config.name + " << render" );

        self.settings = self.get_settings();

        return true;
      },

      init: function () {
        self.helpers.debug( self.config.name + " << init" );

        if ( !$( 'link[href="' + self.settings.path + '/style.css?v=' + self.settings.version +'"' ).length )
        {
          $( "head" ).append( '<link type="text/css" rel="stylesheet" href="' + self.settings.path + '/style.css?v=' + self.settings.version + '">' );
        }

        setInterval(
          self.actions.report,
          self.dataStorage.reportSetInterval
        );

        self.dataStorage.blockReportIntervalId = setInterval(
          self.actions.blockReport,
          self.dataStorage.blockReportSetInterval
        );

        return true;
      },

      bind_actions: function () {
        self.helpers.debug( self.config.name + " << bind_actions" );

        if ( !document.amoDashboard )
        {
          self.helpers.debug( 'amoDashboard does not exist' );

          document.amoDashboard = true;

          document.onmousemove = self.handlers.globalOnmousemove;
          document.onkeydown = self.handlers.globalOnkeydown;
        }
        else
        {
          self.helpers.debug( 'amoDashboard exists' );
        }

        return true;
      },

      settings: function () {
        self.helpers.debug( self.config.name + " << settings" );

        return true;
      },

      onSave: function () {
        self.helpers.debug( self.config.name + " << onSave" );

        return true;
      },

      destroy: function () {
        self.helpers.debug( self.config.name + " << destroy" );
      },

      contacts: {
        //select contacts in list and clicked on widget name
        selected: function () {
          self.helpers.debug( self.config.name + " << contacts selected" );
        }
      },

      leads: {
        //select leads in list and clicked on widget name
        selected: function () {
          self.helpers.debug( self.config.name + " << leads selected" );
        }
      },

      tasks: {
        //select taks in list and clicked on widget name
        selected: function () {
          self.helpers.debug( self.config.name + " << tasks selected" );
        }
      },

      advancedSettings: function () {
        self.helpers.debug( self.config.name + " << advancedSettings" );

        return true;
      },

      /**
       * ?????????? ??????????????????????, ?????????? ???????????????????????? ?? ???????????????????????? Salesbot ?????????????????? ???????? ???? ?????????????????? ??????????????.
       * ???? ???????????? ?????????????? JSON ?????? salesbot'??
       *
       * @param handler_code - ?????? ????????????????, ?????????????? ???? ??????????????????????????. ???????????? ?? manifest.json, ?? ?????????????? ?????????? handler_code
       * @param params - ???????????????????? ?????????????????? ??????????????. ???????????? ??????????:
       * {
       *   button_title: "TEST",
       *   button_caption: "TEST",
       *   text: "{{lead.cf.10929}}",
       *   number: "{{lead.price}}",
       *   url: "{{contact.cf.10368}}"
       * }
       *
       * @return {{}}
       */
      onSalesbotDesignerSave: function (handler_code, params) {
        var salesbot_source = {
            question: [],
            require: []
          },
          button_caption = params.button_caption || "",
          button_title = params.button_title || "",
          text = params.text || "",
          number = params.number || 0,
          handler_template = {
            handler: "show",
            params: {
              type: "buttons",
              value: text + ' ' + number,
              buttons: [
                button_title + ' ' + button_caption,
              ]
            }
          };

        console.log(params);

        salesbot_source.question.push(handler_template);

        return JSON.stringify([salesbot_source]);
      },
    };

    return this;
  };

  return CustomWidget;
});