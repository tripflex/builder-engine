/**
 * @license jQuery wizard plug-in 3.0.7 (18-SEPT-2012)
 *
 *
 * Copyright (c) 2012 Jan Sundman (jan.sundman[at]aland.net)
 *
 * http://www.thecodemine.org
 *
 * Licensed under the MIT licens:
 *   http://www.opensource.org/licenses/mit-license.php
 *
 */

        
var myobject = null;  
(function($){
	$.widget("ui.formwizard", {

		_init: function() {

			var wizard = this;
			var formOptionsSuccess = this.options.formOptions.success;
			var formOptionsComplete = this.options.formOptions.complete;
			var formOptionsBeforeSend = this.options.formOptions.beforeSend;
			var formOptionsBeforeSubmit = this.options.formOptions.beforeSubmit;
			var formOptionsBeforeSerialize = this.options.formOptions.beforeSerialize;
			this.options.formOptions = $.extend(this.options.formOptions,{
				success	: function(responseText, textStatus, xhr){
					if(formOptionsSuccess){
						formOptionsSuccess(responseText, textStatus, xhr);
					}
					if(wizard.options.formOptions && wizard.options.formOptions.resetForm || !wizard.options.formOptions){
						wizard._reset();
					}
				},
				complete : function(xhr, textStatus){
					if(formOptionsComplete){
						formOptionsComplete(xhr, textStatus);
					}
					wizard._enableNavigation();
				},
				beforeSubmit : function(arr, theForm, options) {
					if(formOptionsBeforeSubmit){
						var shouldSubmit = formOptionsBeforeSubmit(arr, theForm, options);
						if(!shouldSubmit)
							wizard._enableNavigation();
						return shouldSubmit;
					}
				},
				beforeSend : function(xhr) {
					if(formOptionsBeforeSend){
						var shouldSubmit = formOptionsBeforeSend(xhr);
						if(!shouldSubmit)
							wizard._enableNavigation();
						return shouldSubmit;
					}
				},
				beforeSerialize: function(form, options) {
					if(formOptionsBeforeSerialize){
						var shouldSubmit = formOptionsBeforeSerialize(form, options);
						if(!shouldSubmit)
							wizard._enableNavigation();
						return shouldSubmit;
					}
				}
			});
			
			if (this.options.historyEnabled) {
				$.bbq.removeState("_" + $(this.element).attr('id'));
			}

			this.steps = this.element.find(".step").hide();

			this.firstStep = this.steps.eq(0).attr("id");
			this.activatedSteps = new Array();
			this.isLastStep = false;
			this.previousStep = undefined;
			this.currentStep = this.steps.eq(0).attr("id");
			this.nextButton	= this.element.find(this.options.next)
					.click(function() {
						return wizard._next();
					});

			this.nextButtonInitinalValue = this.nextButton.val();
			this.nextButton.val(this.options.textNext);

				this.backButton	= this.element.find(this.options.back)
					.click(function() {
						wizard._back();return false;
					});

				this.backButtonInitinalValue = this.backButton.val();
				this.backButton.val(this.options.textBack);

			if(this.options.validationEnabled && jQuery().validate  == undefined){
				this.options.validationEnabled = false;
				if( (window['console'] !== undefined) ){
					console.log("%s", "validationEnabled option set, but the validation plugin is not included");
				}
			}else if(this.options.validationEnabled){
				this.element.validate(this.options.validationOptions);
			}
			if(this.options.formPluginEnabled && jQuery().ajaxSubmit == undefined){
				this.options.formPluginEnabled = false;
				if( (window['console'] !== undefined) ){
					console.log("%s", "formPluginEnabled option set but the form plugin is not included");
				}
			}

			if(this.options.disableInputFields == true){
				$(this.steps).find(":input:not('.wizard-ignore')").attr("disabled","disabled");
			}

			if(this.options.historyEnabled){
				$(window).bind('hashchange', undefined, function(event){
					var hashStep = event.getState( "_" + $(wizard.element).attr( 'id' )) || wizard.firstStep;
					if(hashStep !== wizard.currentStep){
						if(wizard.options.validationEnabled && hashStep === wizard._navigate(wizard.currentStep)){
							if(!wizard.element.valid()){
								wizard._updateHistory(wizard.currentStep);
								wizard.element.validate().focusInvalid();

								return false;
							}
						}
						if(hashStep !== wizard.currentStep)
							wizard._show(hashStep);
					}
				});
			}

			this.element.addClass("ui-formwizard");
			this.element.find(":input").addClass("ui-wizard-content");
			this.steps.addClass("ui-formwizard-content");
			this.backButton.addClass("ui-formwizard-button ui-wizard-content");
			this.nextButton.addClass("ui-formwizard-button ui-wizard-content");

			if(!this.options.disableUIStyles){
				this.element.addClass("ui-helper-reset ui-widget ui-widget-content ui-helper-reset ui-corner-all");
				this.element.find(":input").addClass("ui-helper-reset ui-state-default");
				this.steps.addClass("ui-helper-reset ui-corner-all");
				this.backButton.addClass("ui-helper-reset ui-state-default");
				this.nextButton.addClass("ui-helper-reset ui-state-default");
			}
			this._show(undefined);

			//Custom code
			if(this.options.vertical) {
				this.element.addClass('wizard-vertical');
				this.element.find('.step').wrapAll('<div class="wrap" />');
			}

			if(this.options.showSteps) {
				this.element.find(".wizard-steps").addClass('show');
				var _step = this.element.find(".step");    
				var _steps = _step.find("span");
				this.setDataAttr(_step);
				_steps.hide();
				//vizualize steps in container
				this.showSteps(this.element.find(".wizard-steps"),_steps, _steps.length);
				//get wizard state
				_state = this._state();
				this._setCurrentStep(_state.currentStep, this.element);

                myobject = this;
				this.element.bind("step_shown", function(event, data){
					removeCurrentStep(this);
					myobject._setCurrentStep(data.currentStep, this);
					removeFinishStep(this);
					setFinishStep(data.activatedSteps, data.currentStep, this)
				});


				

				function removeCurrentStep(_this) {
					_this = $(_this);
					wstep = _this.find('.wstep');
					wstep.each(function( index ) {
						if($(this).hasClass('current')) {
							$(this).removeClass('current')
						}
						
					});
				}

				function setFinishStep (activatedSteps, curStep, _this) {
					//wstep = $('.wstep');
					_this = $(_this);
					wstep = _this.find('.wstep');
					num = activatedSteps.length;
					for(var i= 0; i < num; i++ ) {
						if(activatedSteps[i] != curStep ) {
							dataStepNum = $('#'+activatedSteps[i]).attr('data-step-num');
							//dataStepNum = _this.find('#'+activatedSteps[i].attr('data-step-num');
							wstep.each(function( index ) {
								if($(this).attr('data-step-num') == dataStepNum-1) {
									$(this).addClass('done')
								}
							});
						}
					}
				}

				function removeFinishStep (_this) {
					_this = $(_this);
					wstep = _this.find('.wstep');
					wstep.each(function( index ) {
						if($(this).hasClass('done')) {
							$(this).removeClass('done')
						}
						
					});
				}

				//set data-step-num to steps
				

				

			} else {
				this.element.find(".wizard-steps").addClass('hide');
			}

			return $(this);
		},
        setDataAttr : function setDataAttr (step) {
            step.each(function( index ) {
                $(this).attr('data-step-num', index+1);
            });
        },
        //vizualize step container
        showSteps : function showSteps(wizsteps, steps, stepNum) {
            for(var i = 0; i < stepNum; i++) {
                stepText = steps[i].getAttribute('data-text');
                stepIcon = steps[i].getAttribute('data-icon');
                if(i+1 == stepNum) {
                    wizsteps.append(
                        '<div class="wstep last-child" data-step-num="'+i+'"><div class="donut"><i class="icon24 '+stepIcon+'"></i></div><span class="txt">'+stepText+'</span></div>'
                    );
                } else {
                    wizsteps.append(
                        '<div class="wstep" data-step-num="'+i+'"><div class="donut"><i class="icon24 '+stepIcon+'"></i></div><span class="txt">'+stepText+'</span></div>'
                    );
                }
            }
        },
        _setCurrentStep : function setCurrentStep(curStep, _this) {
            //get the data-step-num from current step
            dataStepNum = $('#'+curStep).attr('data-step-num');
            //set current class to current step
            _this = $(_this);
            wstep = _this.find('.wstep');

            wstep.each(function( index ) {
                if($(this).attr('data-step-num') == dataStepNum-1) {
                    $(this).addClass('current')
                }
            });
        },        
		_next : function(){
			if(this.options.validationEnabled){
				if(!this.element.valid()){
					this.element.validate().focusInvalid();
					return false;
				}
			}

			if(this.options.remoteAjax != undefined){
				var options = this.options.remoteAjax[this.currentStep];
				var wizard = this;
				if(options !== undefined){
					var success = options.success;
					var beforeSend = options.beforeSend;
					var complete = options.complete;

					options = $.extend({},options,{
						success: function(data, statusText){
							if((success !== undefined && success(data, statusText)) || (success == undefined)){
								wizard._continueToNextStep();
							}
						},
						beforeSend : function(xhr){
							wizard._disableNavigation();
							if(beforeSend !== undefined)
								beforeSend(xhr);
							$(wizard.element).trigger('before_remote_ajax', {"currentStep" : wizard.currentStep});
						},
						complete : function(xhr, statusText){
							if(complete !== undefined)
								complete(xhr, statusText);
							$(wizard.element).trigger('after_remote_ajax', {"currentStep" : wizard.currentStep});
							wizard._enableNavigation();
						}
					})
					this.element.ajaxSubmit(options);
					return false;
				}
			}

			return this._continueToNextStep();
		},

		_back : function(){
			if(this.activatedSteps.length > 0){
				if(this.options.historyEnabled){
					this._updateHistory(this.activatedSteps[this.activatedSteps.length - 2]);
				}else{
					this._show(this.activatedSteps[this.activatedSteps.length - 2], true);
				}
			}
			return false;
		},

		_continueToNextStep : function(){
			if(this.isLastStep){
				for(var i = 0; i < this.activatedSteps.length; i++){
					this.steps.filter("#" + this.activatedSteps[i]).find(":input").not(".wizard-ignore").removeAttr("disabled");
				}
				if(!this.options.formPluginEnabled){
					return true;
				}else{
					this._disableNavigation();
					this.element.ajaxSubmit(this.options.formOptions);
					return false;
				}
			}

			var step = this._navigate(this.currentStep);
			if(step == this.currentStep){
				return false;
			}
			if(this.options.historyEnabled){
				this._updateHistory(step);
			}else{
				this._show(step, true);
			}
			return false;
		},

		_updateHistory : function(step){
			var state = {};
			state["_" + $(this.element).attr('id')] = step;
			$.bbq.pushState(state);
		},

		_disableNavigation : function(){
			this.nextButton.attr("disabled","disabled");
			this.backButton.attr("disabled","disabled");
			if(!this.options.disableUIStyles){
				this.nextButton.removeClass("ui-state-active").addClass("ui-state-disabled");
				this.backButton.removeClass("ui-state-active").addClass("ui-state-disabled");
			}
		},

		_enableNavigation : function(){
			if(this.isLastStep){
				this.nextButton.val(this.options.textSubmit);
			}else{
				this.nextButton.val(this.options.textNext);
			}

			if($.trim(this.currentStep) !== this.steps.eq(0).attr("id")){
				this.backButton.removeAttr("disabled");
				if(!this.options.disableUIStyles){
					this.backButton.removeClass("ui-state-disabled").addClass("ui-state-active");
				}
			}

			this.nextButton.removeAttr("disabled");
			if(!this.options.disableUIStyles){
				this.nextButton.removeClass("ui-state-disabled").addClass("ui-state-active");
			}
		},

		_animate : function(oldStep, newStep, stepShownCallback){
			this._disableNavigation();
			var old = this.steps.filter("#" + oldStep);
			var current = this.steps.filter("#" + newStep);
			old.find(":input").not(".wizard-ignore").attr("disabled","disabled");
			current.find(":input").not(".wizard-ignore").removeAttr("disabled");
			var wizard = this;
			old.animate(wizard.options.outAnimation, wizard.options.outDuration, wizard.options.easing, function(){
				current.animate(wizard.options.inAnimation, wizard.options.inDuration, wizard.options.easing, function(){
					if(wizard.options.focusFirstInput)
						current.find(":input:first").focus();
					wizard._enableNavigation();

					stepShownCallback.apply(wizard);
				});
				return;
			});
		},

		_checkIflastStep : function(step){
			this.isLastStep = false;
			if($("#" + step).hasClass(this.options.submitStepClass) || this.steps.filter(":last").attr("id") == step){
				this.isLastStep = true;
			}
		},

		_getLink : function(step){
			var link = undefined;
			var links = this.steps.filter("#" + step).find(this.options.linkClass);

			if(links != undefined){
				if(links.filter(":radio,:checkbox").size() > 0){
					link = links.filter(this.options.linkClass + ":checked").val();
				}else{
					link = $(links).val();
				}
			}
			return link;
		},

		_navigate : function(step){
			var link = this._getLink(step);
			if(link != undefined){
				if((link != "" && link != null && link != undefined) && this.steps.filter("#" + link).attr("id") != undefined){
					return link;
				}
				return this.currentStep;
			}else if(link == undefined && !this.isLastStep){
				var step1 =  this.steps.filter("#" + step).next().attr("id");
				return step1;
			}
		},

		_show : function(step){
			var backwards = false;
			var triggerStepShown = step !== undefined;
			if(step == undefined || step == ""){
					this.activatedSteps.pop();
					step = this.firstStep;
					this.activatedSteps.push(step);
			}else{
				if($.inArray(step, this.activatedSteps) > -1){
					backwards = true;
					this.activatedSteps.pop();
				}else {
					this.activatedSteps.push(step);
				}
			}

			if(this.currentStep !== step || step === this.firstStep){
				this.previousStep = this.currentStep;
				this._checkIflastStep(step);
				this.currentStep = step;
				var stepShownCallback = function(){if(triggerStepShown){$(this.element).trigger('step_shown', $.extend({"isBackNavigation" : backwards},this._state()));}}
				if(triggerStepShown){
					$(this.element).trigger('before_step_shown', $.extend({"isBackNavigation" : backwards},this._state()));
				}
				this._animate(this.previousStep, step, stepShownCallback);
			};


		},

	   _reset : function(){
			this.element.resetForm()
			$("label,:input,textarea",this).removeClass("error");
			for(var i = 0; i < this.activatedSteps.length; i++){
				this.steps.filter("#" + this.activatedSteps[i]).hide().find(":input").attr("disabled","disabled");
			}
			this.activatedSteps = new Array();
			this.previousStep = undefined;
			this.isLastStep = false;
			if(this.options.historyEnabled){
				this._updateHistory(this.firstStep);
			}else{
				this._show(this.firstStep);
			}

		},

		_state : function(state){
			var currentState = { "settings" : this.options,
				"activatedSteps" : this.activatedSteps,
				"isLastStep" : this.isLastStep,
				"isFirstStep" : this.currentStep === this.firstStep,
				"previousStep" : this.previousStep,
				"currentStep" : this.currentStep,
				"backButton" : this.backButton,
				"nextButton" : this.nextButton,
				"steps" : this.steps,
				"firstStep" : this.firstStep
			}

			if(state !== undefined)
				return currentState[state];

			return currentState;
		},

	  /*Methods*/

		show : function(step){
			if(this.options.historyEnabled){
				this._updateHistory(step);
			}else{
				this._show(step);
			}
		},

		state : function(state){
			return this._state(state);
		},

		reset : function(){
			this._reset();
		},

		next : function(){
			this._next();
		},

		back : function(){
			this._back();
		},

		destroy: function() {
			this.element.find("*").removeAttr("disabled").show();
			this.nextButton.unbind("click").val(this.nextButtonInitinalValue).removeClass("ui-state-disabled").addClass("ui-state-active");
			this.backButton.unbind("click").val(this.backButtonInitinalValue).removeClass("ui-state-disabled").addClass("ui-state-active");
			this.backButtonInitinalValue = undefined;
			this.nextButtonInitinalValue = undefined;
			this.activatedSteps = undefined;
			this.previousStep = undefined;
			this.currentStep = undefined;
			this.isLastStep = undefined;
			this.options = undefined;
			this.nextButton = undefined;
			this.backButton = undefined;
			this.formwizard = undefined;
			this.element = undefined;
			this.steps = undefined;
			this.firstStep = undefined;
		},

		update_steps : function(){
			this.steps = this.element.find(".step").addClass("ui-formwizard-content");
			this.firstStep = this.steps.eq(0).attr("id");
			this.steps.not("#" + this.currentStep).hide().find(":input").addClass("ui-wizard-content").attr("disabled","disabled");
			this._checkIflastStep(this.currentStep);
			this._enableNavigation();
			if(!this.options.disableUIStyles){
				this.steps.addClass("ui-helper-reset ui-corner-all");
				this.steps.find(":input").addClass("ui-helper-reset ui-state-default");
			}
		},

		options: {
	   		historyEnabled	: false,
			validationEnabled : false,
			validationOptions : undefined,
			formPluginEnabled : false,
			linkClass	: ".link",
			submitStepClass : "submit_step",
			back : ":reset",
			next : ":submit",
			textSubmit : 'Submit',
			textNext : 'Next',
			textBack : 'Back',
			remoteAjax : undefined,
			inAnimation : {opacity: 'show'},
			outAnimation: {opacity: 'hide'},
			inDuration : 400,
			outDuration: 400,
			easing: 'swing',
			focusFirstInput : false,
			disableInputFields : true,
			formOptions : { reset: true, success: function(data) { if( (window['console'] !== undefined) ){console.log("%s", "form submit successful");}},
			disableUIStyles : false,
			showSteps: false,
			vertical: false
		}
   }
 });
})(jQuery);
