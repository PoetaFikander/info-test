"use strict";
import {$overlaySpinner} from "../c.js";

console.log('module users start');

import {ax, fx} from "../f.js";

import {
    UsersList,
} from "./users-f.js";
import {EmployeesList} from "../staff/employees-f.js";

const sourcePathName = window.location.pathname;
const section = sourcePathName.split('/')[1];
const module = sourcePathName.split('/')[2];
const subModule = sourcePathName.split('/')[3];

//console.log(`sourcePathName: ${sourcePathName}`);
//console.log(`section: ${section}`);
//console.log(`module: ${module}`);
//console.log(`subModule: ${subModule}`);

if (section === 'users') {
    (async () => {
        $overlaySpinner.fadeIn(300);
        const [
            currentUserData,
            users,
        ] = await Promise.all([
            fx('/axhelp/getCurrentUserData'),
            fx('/axhelp/getUsersList'),
        ]);
        const temp = new UsersList({
            currentUserData: currentUserData,
            users: users,
        });
        $overlaySpinner.fadeOut(300);
    })();
}
