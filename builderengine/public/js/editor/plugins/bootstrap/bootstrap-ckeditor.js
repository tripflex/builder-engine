CKEDITOR.plugins.add( 'bootstrap',
{
   requires : ['richcombo'],
   init : function( editor )
   {
      var config = editor.config,
         lang = editor.lang.format;

      // Gets the list of tags from the settings.
      var tags = []; //new Array();
      tags[0]=["{{ bootstrap:alert style=%27info%27 }} My Content {{ /bootstrap:alert }}", "Alert", "Alert"];
      tags[1]=["{{ bootstrap:align position=%27left%27 }} My Content {{ /bootstrap:align }}", "Align", "Align"];
      tags[2]=["{{ bootstrap:badge style=%27%27 }} My Content {{ /bootstrap:badge }}", "Badge", "Badge"];
      tags[3]=["{{ bootstrap:carousel slug=%27Gallery Slug%27 }}", "Carousel", "Carousel"];
      tags[4]=["{{ bootstrap:collapse title=%27My Title%27 }} My Content  {{ /bootstrap:collapse }}", "Collapse", "Collapse"];
      tags[5]=["{{ bootstrap:emphasis style=%27%27 }} My Content  {{ /bootstrap:emphasis }}", "Emphasis", "Emphasis"];
      tags[6]=["{{ bootstrap:hero }} My Content  {{ /bootstrap:hero }}", "Hero", "Hero"];
      tags[7]=["{{ bootstrap:label style=%27%27 }} My Content {{ /bootstrap:label }}", "Label", "Label"];
      tags[8]=["{{ bootstrap:lead }} My Content  {{ /bootstrap:lead }}", "Lead", "Lead"];
      tags[9]=["{{ bootstrap:row }} {{ bootstrap:span size=%27%27 }} My Content  {{ /bootstrap:span }} {{ /bootstrap:row }}", "Row - Span", "Row - Span"];
      tags[10]=["{{ bootstrap:tabheaderwrap }}<p>{{ bootstrap:tabheader title=%27Tab One%27 active=%27true%27 }}</p><p>{{ bootstrap:tabheader title=%27Tab Two%27 }}</p><p>{{ /bootstrap:tabheaderwrap }}</p><p>{{ bootstrap:tabcontentwrap }}</p><p>{{ bootstrap:tabcontent title=%27Tab One%27 active=%27true%27 }}Tab one contents goes here{{ /bootstrap:tabcontent }}</p><p>{{ bootstrap:tabcontent title=%27Tab Two%27 }} Tab two contents goes here{{ /bootstrap:tabcontent }}</p><p>{{ /bootstrap:tabcontentwrap }}</p>", "Tabs", "Tabs"];
      tags[11]=["{{ bootstrap:well }} My Content  {{ /bootstrap:well }}", "Well", "Well"];
      
      // Create style objects for all defined styles.

      editor.ui.addRichCombo( 'bootstrap',
         {
            label : "Bootstrap",
            voiceLabel : "Bootstrap",
            className : 'cke_format',
            multiSelect : false,

            panel :
            {
               css : [ config.contentsCss, CKEDITOR.getUrl( 'skins/moono/editor.css' ) ],
               voiceLabel : lang.panelVoiceLabel
            },

            init : function()
            {
               for (var this_tag in tags){
                  this.add(tags[this_tag][0], tags[this_tag][1], tags[this_tag][2]);
               }
            },

            onClick : function( value )
            {
               editor.focus();
               editor.fire( 'saveSnapshot' );
               editor.insertHtml(unescape(value));
               editor.fire( 'saveSnapshot' );
            }
         });
   }
});

/*

Include this file:
   // get path of directory ckeditor
   var basePath = CKEDITOR.basePath;
   basePath = basePath.substr(0, basePath.indexOf("ckeditor/"));
   (function() {
      CKEDITOR.plugins.addExternal('bootstrap',basePath+'../../../../../addons/shared_addons/themes/MY_THEME/js/', 'bootstrap-ckeditor.js');
   })();

Edit
protectedSource: /{{(\s)?.[^}]+(\s)?}}/g

to be:

protectedSource: /(?!({{\s?bootstrap:(.*)\s?}}))(?!({{\s?\/bootstrap:(.*)\s?}})){{(\s)?.[^}]+(\s)?}}/g

Add 'bootstrap' to extra plugins:
   extraPlugins: 'pyroimages,pyrofiles,bootstrap',

Then add 'bootstrap' to a toolbar

*/