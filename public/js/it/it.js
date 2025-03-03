"use strict";
import {$overlaySpinner} from "../c.js";

console.log('module it start');

import {ax, fx} from "../f.js";

import {
    AliasesList,
    DynamicTablesList,
    DynamicTableColumnUpdate,
} from "./it-f.js";
import {UsersList} from "../users/users-f.js";


const sourcePathName = window.location.pathname;
const section = sourcePathName.split('/')[1];
const module = sourcePathName.split('/')[2];
const subModule = sourcePathName.split('/')[3];

console.log(`sourcePathName: ${sourcePathName}`);
console.log(`section: ${section}`);
console.log(`module: ${module}`);
console.log(`subModule: ${subModule}`);

if (section === 'it' && module === 'aliases') {
    const temp = new AliasesList({});
}

if (section === 'dynamic-tables' && module === undefined) {
    (async () => {
        $overlaySpinner.fadeIn(300);
        const [
            tables,
        ] = await Promise.all([
            fx('/axhelp/getDynamicTablesList'),
        ]);
        const temp = new DynamicTablesList({
            tables: tables,
        });
        $overlaySpinner.fadeOut(300);
    })();
}

if (section === 'dynamic-tables' && subModule === 'edit') {
    const temp = new DynamicTableColumnUpdate();
}
