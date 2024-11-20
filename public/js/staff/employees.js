"use strict";
console.log('module employees start');

import {$overlaySpinner} from "../c.js";

import {ax} from "../f.js";

import {
    EmployeeCreate,
    EmployeesList,
} from "./employees-f.js";

//console.log(window.location);
const sourcePathName = window.location.pathname;
const section = sourcePathName.split('/')[1];
const module = sourcePathName.split('/')[2];
const subModule = sourcePathName.split('/')[3];

console.log(`sourcePathName: ${sourcePathName}`);
console.log(`section: ${section}`);
console.log(`module: ${module}`);
console.log(`subModule: ${subModule}`);


if (section === 'staff' && module === 'employees' && subModule !== 'create') {
    $overlaySpinner.fadeIn(300);
    ax(
        {},
        '/axhelp/getDataForEmployeesList',
        function (data) {
            //console.log(data)
            const temp = new EmployeesList(data);
            $overlaySpinner.fadeOut(300);
        }
    )
}

if (section === 'staff' && module === 'employees' && subModule === 'create') {
    $overlaySpinner.fadeIn(300);
    ax(
        {},
        '/axhelp/getCurrentUserData',
        function (data) {
            //console.log(data)
            const temp = new EmployeeCreate(data);
            $overlaySpinner.fadeOut(300);
        }
    )
}
