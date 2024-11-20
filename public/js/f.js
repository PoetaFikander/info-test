"use strict";
console.log('module global function start');

function ax(params, url, callback, method = 'post') {

    callback = (callback !== undefined && callback !== null) ? callback : false;

    if (method === 'post') {
        console.group(`function ax POST`);
        axios.post(url, params)
            .then(response => {
                if (callback) callback(response.data);
            })
            .catch((error) => {
                if (error.response) {
                    console.log('server responded');
                    console.log(error.response.data);
                    console.log(error.response.status);
                    console.log(error.response.headers);
                } else if (error.request) {
                    console.log('network error');
                    console.log(error.request);
                } else {
                    console.log('Error', error.message);
                }
                console.log(error.config);
            });
        console.groupEnd();
    }

    // if (method === 'delete') {
    //     axios.delete(url, params)
    //         .then(response => {
    //             if (callback) callback(response.data);
    //         })
    //         .catch((error) => {
    //             if (error.response) {
    //                 console.log('server responded');
    //                 console.log(error.response);
    //             } else if (error.request) {
    //                 console.log('network error');
    //             } else {
    //                 console.log(error);
    //             }
    //         });
    // }

}


/**
 * gets the values of all form elements
 * @param $form
 * @returns {{}}
 */
function getParametersFromForm($form) {

    //console.group("function getParametersFromForm");

    const params = {};
    $('input, select, textarea, radio', $form).each(
        function (index) {
            const $node = $(this);
            //console.log($node);
            const nodeName = $node[0].nodeName;
            //console.log(`nodeName: ${nodeName}`);
            const type = $node.attr('type');
            //console.log(`type: ${type}`);
            const name = $node.attr('name');
            //console.log(`name: ${name}`);

            if (nodeName === 'INPUT' && type !== undefined && type !== 'radio' && name !== undefined) {
                switch (type) {
                    case 'checkbox':
                        params[name] = $node.prop('checked');
                        break;
                    case 'number':
                        params[name] = isNaN($node.val()) ? 0 : parseFloat($node.val());
                        break;
                    case 'hidden':
                        params[name] = isNaN($node.val()) ? $node.val() : parseInt($node.val());
                        break;
                    case 'text':
                        params[name] = $node.val();
                        break;
                    case 'search':
                        params[name] = $node.val();
                        break;
                    default:
                        params[name] = $node.val();
                }
            }

            if (nodeName === 'INPUT' && type === 'radio' && name !== undefined) {
                if ($node.prop('checked')) {
                    params[name] = $node.val()
                }
            }

            if (nodeName === 'SELECT' && name !== undefined) {
                params[name] = isNaN($node.val()) ? $node.val() : parseInt($node.val());
            }

            if (nodeName === 'TEXTAREA' && name !== undefined) {
                params[name] = $node.val();
            }

        }
    );
    //console.groupEnd();

    return params;
}

function selectOptionAdd($select, value, text) {
    let html = '<option value="' + value + '">' + text + '</option>';
    $select.append(html);
}


function isInteger(a) {
    //return ((typeof n === 'number') && (n % 1 === 0));
    return a - a === 0 && a.toString(32).indexOf('.') === -1
}

function isFloat(a) {
    //return ((typeof n === 'number') && (n % 1 !== 0));
    return a - a === 0 && a.toString(32).indexOf('.') !== -1
}

function isNumber(n) {
    //return (typeof n === 'number');
    return !isNaN(n);
}

function roundNearest(n, fractDigits) {
    const factor = Math.pow(10, fractDigits)
    return Math.round(n * factor) / factor
}

function matchingNumericTypes(input) {
    for (const n in input) {
        if (Object.hasOwn(input, n)) {
            let i = input[n];
            //if (i !== null && i.length > 0) {
            if (isNumber(i)) {
                if (isInteger(i)) input[n] = parseInt(i);
                if (isFloat(i)) {
                    input[n] = roundNearest(parseFloat(i), 2);
                }
            }
            //}
        }
    }
}

function paramsToParams(params) {
    //console.log(typeof params);
    //if(typeof params === "object"){
    for (let n in params) {
        let i = params[n];
        if (i !== null && i.length > 0) {
            if (isNumber(i)) {
                if (isInteger(i)) params[n] = parseInt(i);
                if (isFloat(i)) {
                    //params[n] = parseFloat(i).toFixed(2);
                    params[n] = roundNearest(parseFloat(i), 2);
                }
            }
        }
    }
    //}
}

function objLoop(obj, callback, params = {}) {
    callback = $.isFunction(callback) ? callback : false;
    Object.entries(obj).forEach(entry => {
            const [key, value] = entry;
            if (typeof value === "object") {
                //paramsToParams(value);
                matchingNumericTypes(value);
            }
            if (callback) {
                callback(key, value, obj, params);
            }
        }
    )
}

// ----
export {
    ax,
    getParametersFromForm,
    selectOptionAdd,
    matchingNumericTypes,
    objLoop,

}
