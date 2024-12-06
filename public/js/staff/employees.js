"use strict";
import {MifCompany} from "../reports/reports-f.js";

console.log('module employees start');

import {$overlaySpinner} from "../c.js";

import {ax, fx} from "../f.js";

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
    (async () => {
        $overlaySpinner.fadeIn(300);
        const [
            currentUserData,
            employees,
        ] = await Promise.all([
            fx('/axhelp/getCurrentUserData'),
            fx('/axhelp/getEmployeesList'),
        ]);
        const temp = new EmployeesList({
            currentUserData: currentUserData,
            employees: employees,
        });
        $overlaySpinner.fadeOut(300);
    })();
}

if (section === 'staff' && module === 'employees' && subModule === 'create') {
    (async () => {
        $overlaySpinner.fadeIn(300);
        const [
            currentUserData,
        ] = await Promise.all([
            fx('/axhelp/getCurrentUserData'),
        ]);
        const temp = new EmployeeCreate({
            currentUserData: currentUserData,
        });
        $overlaySpinner.fadeOut(300);
    })();
}
