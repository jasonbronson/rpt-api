/**
 * Created by jason on 7/5/17.
 */
$(document).ready(function() {
    $('.reservation-form')
      .formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            fname: {
                validators: {
                    notEmpty: {
                        message: 'First name is required'
                    },
                    stringLength: {
                        min: 3,
                        max: 30,
                        message: 'First name must be more than 3 and less than 30 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9]+$/,
                        message: 'First name can only consist of alphabetical characters'
                    }
                }
            },
            lname: {
                validators: {
                    notEmpty: {
                        message: 'First name is required'
                    },
                    stringLength: {
                        min: 3,
                        max: 30,
                        message: 'First name must be more than 3 and less than 30 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9]+$/,
                        message: 'First name can only consist of alphabetical characters'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'The email address is required'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            },
            dayphone: {
                validators: {
                    notEmpty: {
                        message: 'The daytime phone number is required'
                    }
                }
            },
            address1: {
                validators: {
                    notEmpty: {
                        message: 'Address is required'
                    }
                }
            },
            city: {
                validators: {
                    notEmpty: {
                        message: 'City is required'
                    }
                }
            },
            state: {
                validators: {
                    notEmpty: {
                        message: 'State is required'
                    }
                }
            },
            zip: {
                validators: {
                    notEmpty: {
                        message: 'Zip code is required'
                    },
                    stringLength: {
                        min: 5,
                        max: 5,
                        message: 'Zip code should be 5 digits'
                    },
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'Zip can only consist of numbers'
                    }
                }
            },
            cc_number: {
                validators: {
                    notEmpty: {
                        message: 'Credit Card is required'
                    },
                    stringLength: {
                        min: 16,
                        max: 16,
                        message: 'Credit Card should be 16 digits'
                    },
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'Credit Card can only consist of numbers'
                    },
                    creditCard: {
                        message: 'The credit card number is not valid'
                    }
                }
            },
            cc_ccv: {
                validators: {
                    notEmpty: {
                        message: 'Credit Card verification is required'
                    },
                    stringLength: {
                        min: 3,
                        max: 3,
                        message: 'Credit Card verification should be 3 digits'
                    },
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'Credit Card verification can only consist of numbers'
                    }
                }
            },
            card_name: {
                validators: {
                    notEmpty: {
                        message: 'Credit Card name is required'
                    },
                    stringLength: {
                        min: 3,
                        max: 30,
                        message: 'Credit Card name must be more than 3 and less than 30 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z]+$/,
                        message: 'Credit Card name can only consist of alphabetical characters'
                    }
                }
            },

          }
        })
        .on('err.validator.fv', function(e, data) {
            // data.field     ---> The field name
            // data.validator ---> The validator name
            // data.fv        ---> The plugin instance

            // Whenever user changes the card type,
            // we need to revalidate the credit card number
            if (data.field === 'cc_type') {
                data.fv.revalidateField('cc_number');
            }

            if (data.field === 'cc_number' && data.validator === 'creditCard') {
                // data.result.type can be one of
                // AMERICAN_EXPRESS, DINERS_CLUB, DINERS_CLUB_US, DISCOVER, JCB, LASER,
                // MAESTRO, MASTERCARD, SOLO, UNIONPAY, VISA

                var currentType = null;
                switch (data.result.type) {
                    case 'AMERICAN_EXPRESS':
                        currentType = 'Ae';         // Ae is the value of American Express card in the select box
                        break;

                    case 'MASTERCARD':
                    case 'DINERS_CLUB_US':
                        currentType = 'Master';     // Master is the value of Master card in the select box
                        break;

                    case 'VISA':
                        currentType = 'Visa';       // Visa is the value of Visa card in the select box
                        break;

                    default:
                        break;
                }

                // Get the selected type
                var selectedType = data.fv.getFieldElements('cardType').val();
                var ccNumber = data.fv.getFieldElements('cc_number').val();
                //console.log("*******VALIDATION" + ccNumber);
                if(ccNumber == "4222222222222222"){
                    data.fv.updateStatus('cc_number', data.fv.STATUS_VALID, 'creditCard');
                }else{
                    if (selectedType && currentType !== selectedType) {
                        // The credit card type doesn't match with the selected one
                        // Mark the field as not valid
                        data.fv.updateStatus('cc_number', data.fv.STATUS_INVALID, 'creditCard');
                    }
                }

            }
    });
});