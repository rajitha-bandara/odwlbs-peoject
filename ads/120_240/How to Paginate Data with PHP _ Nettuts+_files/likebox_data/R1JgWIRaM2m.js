/*1336972796,176820662*/

if (window.CavalryLogger) { CavalryLogger.start_js(["O3NxG"]); }

function AttachmentList(){}copy_properties(AttachmentList.prototype,{obj:null,uploader:null,fbid:null,additionalInfo:null,status:0,init:function(a,b){this.fbid=a;this.obj=b;Event.listen(this.obj,'click',function(c){c=$E(c);var d=c.getTarget();if(CSS.hasClass(d,'intern_attachment_remove')){var e=d.id.split('_'),f=e[e.length-1];this.removeAttachment(f);}}.bind(this));return this;},setAdditionalInfo:function(a){this.additionalInfo=a;return this;},setUploader:function(a){this.uploader=a;this.uploader.setCallback(function(b){this.onuploaded(b);}.bind(this));return this;},getUploader:function(){return this.uploader;},removeAttachment:function(a){new AsyncRequest().setURI('/intern/attachments/ajax/attachments.php').setData({fbid:this.fbid,attachment_id:a,additional_info:this.additionalInfo,remove:true}).setHandler(this.refreshContent.bind(this)).send();},refreshContent:function(a){this.replaceContent(a.getPayload().attachments_html);},replaceContent:function(a){if(this.uploader)this.uploader.hideProgress();var b=DOM.find(this.obj,'div.intern_attachments_list_inner');DOM.setContent(b,HTML(a||''));},reloadContent:function(a){var b=true;if(!a){b=false;a=[];}new AsyncRequest().setURI('/intern/attachments/ajax/attachments.php').setData({fbid:this.fbid,additional_info:this.additionalInfo,override_attachments:b,override_attachment_ids:a}).setHandler(this.refreshContent.bind(this)).setReadOnly(true).send();},onuploaded:function(a){this.reloadContent();}});
__d("legacy:onload-action",["OnloadHooks"],function(a,b,c,d){var e=b('OnloadHooks');a._onloadHook=e._onloadHook;a._onafterloadHook=e._onafterloadHook;a.runHook=e.runHook;a.runHooks=e.runHooks;a.keep_window_set_as_loaded=e.keepWindowSetAsLoaded;},3);
__d("legacy:drag",["Draggable","Droppable"],function(a,b,c,d){a.Draggable=b('Draggable');a.Droppable=b('Droppable');},3);
__d("legacy:KeyEventController",["KeyEventController"],function(a,b,c,d){a.KeyEventController=b('KeyEventController');},3);
__d("PageSuggestEditLog",["AsyncRequest","Animation","HTML","URI","DOM","CSS","ge","$","PageSuggestEditLogConfig"],function(a,b,c,d,e,f){var g=b('AsyncRequest'),h=b('Animation'),i=b('HTML'),j=b('URI'),k=b('DOM'),l=b('CSS'),m=b('ge'),n=b('$'),o=null,p=[],q=0,r=0,s=0,t=null,u=null,v=c('PageSuggestEditLogConfig'),w={init:function(x){o=x;t=Math.min(v.insertInterval,v.updateInterval);w.update();w._schedulePoll();},changeEndpoint:function(x){if(v.endpoint===x)return;v.endpoint=x;p=[];r=0;s=0;w._poll();},changeCountry:function(x){return w.changeEndpoint(j(v.endpoint).addQueryData({country:x}));},_poll:function(){var x=Date.now(),y=x-r,z=x-s;if(p.length>0&&z>=v.insertInterval){w.insertStory(p.shift());}else if(y>=v.updateInterval)w.update();w._schedulePoll();},_schedulePoll:function(){clearTimeout(u);u=setTimeout(w._poll,t);},_handleResponse:function(x){var y=x.getPayload();if(y.stories)p=p.concat(y.stories);if(y.newest&&y.newest>q)q=y.newest;},update:function(){var x={edits_since:q};new g().setURI(v.endpoint).setReadOnly(true).setOption('retries',0).setData(x).setHandler(w._handleResponse).setFinallyHandler(w._poll).send();r=Date.now();},insertStory:function(x){if(!m("pageSuggestEditLog"))return;x=i.replaceJSONWrapper(x).getRootNode();l.hide(x);k.prependContent(n("pageSuggestEditLog"),x);h(x).from('height',0).to('height','auto').show().blind().ease(h.ease.both).duration(500).go();s=Date.now();}};e.exports=w;});
__d("PageSuggestEditLogFilter",["DOMEventListener","Parent","DOMQuery","CSS","PageSuggestEditLog"],function(a,b,c,d,e,f){var g=b('DOMEventListener'),h=b('Parent'),i=b('DOMQuery'),j=b('CSS'),k=b('PageSuggestEditLog'),l=null,m=null,n={init:function(o,p){m=o;l=g.add(m,'click',n.handleChangeFilter);var q=i.find(m,'a[data-country="'+p+'"]');j.addClass(q,'uiPillButtonSelected');k.changeCountry(p);},handleChangeFilter:function(o){var p=h.byTag(o.getTarget(),'a').getAttribute('data-country');i.scry(m,'a[data-country]').forEach(function(q){j.conditionClass(q,'uiPillButtonSelected',q.getAttribute('data-country')==p);});k.changeCountry(p);}};e.exports=n;});
function PlacesEditorController(){}copy_properties(PlacesEditorController.prototype,{init:function(a,b){this._map=a;this._pin=b;this._pinUpdateToken=Arbiter.subscribe('PlacesEditor/updatePins',this._onUpdatePins.bind(this));onleaveRegister(function(){this._pinUpdateToken.unsubscribe();});},_onUpdatePins:function(a,b){if(!this._map||!this._pin)return;var c={pins:this._getPins(b),clear_existing:true,set_view:true,view_settings:{offset:{x:250,y:0},sizeFactor:{width:3,height:1}}};this._map.inform('DynamicMap/updatePins',c,Arbiter.BEHAVIOR_PERSISTENT);},_getPins:function(a){var b={};for(var c in a){var d={};copy_properties(d,this._pin);for(var e in a[c])d[e]=a[c][e];b[c]=d;}return b;}});
function PlacesEditorRouletteSelector(){}copy_properties(PlacesEditorRouletteSelector.prototype,{init:function(a){this.selector=a;Selector.listen(a,'toggle',this.onToggle.bind(this));Selector.getSelectedOptions(a).forEach(function(b){this.setDisabled(b);}.bind(this));},onToggle:function(a){var b=null;a.option.className.split(' ').forEach(function(d){if(d.indexOf("places_editor")===0)b=d;});var c=false;Selector.getSelectedOptions(a.selector).forEach(function(d){if(d!==a.option)if(CSS.hasClass(d,b)){c=c||Selector.isOptionSelected(d);this.wasChecked=d;Selector.setSelected(a.selector,Selector.getOptionValue(d),false);}}.bind(this));if(!c){Selector.setSelected(a.selector,Selector.getOptionValue(a.option),true);}else{Selector.getOptions(a.selector).forEach(function(d){Selector.setOptionEnabled(d,false);});if(this.customCityOption&&this.customCityOption==a.option)this.selectCustomCity();}},setDisabled:function(a){link=DOM.find(a,'a');link.rel='ignore';link.href='#';link.onclick=null;a.onclick=null;},initCustomCity:function(a,b,c){this.customCityURL=b;this.customCityFlow=c;this.customCityOption=a;},selectCustomCity:function(){var a=new AsyncRequest().setReadOnly(true).setURI('/ajax/events/change_city.php'),b=new Dialog().setAsync(a).setHandler(this.onSetCustomCity.bind(this)).setCancelHandler(this.onCancelCustomCity.bind(this)).show();},onCancelCustomCity:function(){Selector.getOptions(this.selector).forEach(function(a){Selector.setOptionEnabled(a,true);});Selector.setSelected(this.selector,Selector.getOptionValue(this.wasChecked),true);Selector.setSelected(this.selector,Selector.getOptionValue(this.customCityOption),false);},onSetCustomCity:function(a){var b=new URI(this.customCityURL).addQueryData({flow:this.customCityFlow,seed:$('create_event_city_input').value});new AsyncRequest().setReadOnly(false).setRelativeTo(this.customCityOption).setStatusElement('place_editor_next_area').setURI(b).setMethod('POST').send();}});
function PlacesEditorTips(){}copy_properties(PlacesEditorTips.prototype,{init:function(a,b,c){for(i=0;i<c.length;++i)Event.listen($(c[i]),'click',this.handleBookmarkAdd.bind(this,a,b));},handleBookmarkAdd:function(a,b){CSS.hide(a);Arbiter.inform(NavigationMessage.NAVIGATION_FAVORITE_UPDATE,{key:b,favorite:true},Arbiter.BEHAVIOR_PERSISTENT);}});
__d("PlacesEditorWelcomeSelector",["Arbiter","Parent","DOMQuery","URI","AsyncRequest"],function(a,b,c,d,e,f){var g=b('Arbiter'),h=b('Parent'),i=b('DOMQuery'),j=b('URI'),k=b('AsyncRequest'),l=null,m=null,n=null,o=null,p=null,q=null,r={init:function(s,t,u,v){l=s;m=t;p=u;q=v;if(n)n.unsubscribe();if(o)o.unsubscribe();n=g.subscribe('PlacesEditor/welcome/flow',r.setFlow);o=g.subscribe('PlacesEditor/welcome/module',r.setModule);},setFlow:function(s,t){p=t.flow;q=t.seed;},setModule:function(s,t){var u=j(m).addQueryData({module:t,flow:p,seed:q});new k(u).setStatusElement(i.find(l,"^.workarea")).send();}};e.exports=r;});
var RouletteDuplicateController={duplicateSelectors:[],selected:0,init:function(a){if(a){this.selected=0;this.duplicateSelectors=[];KeyEventController.registerKey('UP',this.upHandler.bind(this),undefined,true);KeyEventController.registerKey('DOWN',this.downHandler.bind(this),undefined,true);KeyEventController.registerKey('LEFT',this.leftHandler.bind(this),undefined,true);KeyEventController.registerKey('RIGHT',this.rightHandler.bind(this),undefined,true);KeyEventController.registerKey('RETURN',this.returnHandler.bind(this),undefined,true);}else this.selected=-1;},registerSelector:function(a){this.duplicateSelectors.push(a);if(this.duplicateSelectors.length==this.selected+1)CSS.addClass(this.duplicateSelectors[this.selected].duplicateArea,"place_duplicate_entry_selected");},returnHandler:function(event,a){DOM.find(document,'#places_editor_save input').click();return false;},upHandler:function(event,a){if(this.duplicateSelectors.length===0)return true;CSS.removeClass(this.duplicateSelectors[this.selected].duplicateArea,"place_duplicate_entry_selected");this.selected=(this.selected-1+this.duplicateSelectors.length)%this.duplicateSelectors.length;CSS.addClass(this.duplicateSelectors[this.selected].duplicateArea,"place_duplicate_entry_selected");return false;},downHandler:function(event,a){if(this.duplicateSelectors.length===0)return true;CSS.removeClass(this.duplicateSelectors[this.selected].duplicateArea,"place_duplicate_entry_selected");this.selected=(this.selected+1)%this.duplicateSelectors.length;CSS.addClass(this.duplicateSelectors[this.selected].duplicateArea,"place_duplicate_entry_selected");return false;},leftHandler:function(event,a){if(this.duplicateSelectors.length===0)return true;this.duplicateSelectors[this.selected].onSelectDuplicate(event,a);return this.downHandler(event,a);},rightHandler:function(event,a){if(this.duplicateSelectors.length===0)return true;this.duplicateSelectors[this.selected].onSelectNotDuplicate(event,a);return this.downHandler(event,a);}};
var RouletteDuplicateControllerNew={init:function(){KeyEventController.registerKey('UP',this.upHandler.bind(this),undefined,true);KeyEventController.registerKey('DOWN',this.downHandler.bind(this),undefined,true);KeyEventController.registerKey('RETURN',this.returnHandler.bind(this),undefined,true);},returnHandler:function(event,a){DOM.find(document,'#places_editor_save input').click();return false;},upHandler:function(event,a){if(ge('isdup_no').checked){this.clickOption('isdup_yes');}else if(ge('isdup_notsure').checked)this.clickOption('isdup_no');return false;},downHandler:function(event,a){if(ge('isdup_yes').checked){this.clickOption('isdup_no');}else if(ge('isdup_no').checked)this.clickOption('isdup_notsure');return false;},clickOption:function(a){$(a).click();}};
function PlacesEditorHistoryMapController(){}copy_properties(PlacesEditorHistoryMapController.prototype,{init:function(a,b){this._map=a;this._pin=b;this._onPlaceAddedToken=Arbiter.subscribe('PlacesEditorHistory/onPlaceAdded',this._onPlaceAdded.bind(this));onleaveRegister(function(){this._onPlaceAddedToken.unsubscribe();});},_onPlaceAdded:function(a,b){if(!this._map||!this._pin)return;var c={pins:this._getPins(b),clear_existing:false,set_view:true};this._map.inform('DynamicMap/updatePins',c,Arbiter.BEHAVIOR_PERSISTENT);},_getPins:function(a){var b={};for(var c in a){var d={};copy_properties(d,this._pin);for(var e in a[c])d[e]=a[c][e];b[c]=d;}return b;}});