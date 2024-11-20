"use strict";
console.log('module reports start');

import {ax} from "../f.js";

import {
    MifCompany,
} from "./reports-f.js";

const sourcePathName = window.location.pathname;
const section = sourcePathName.split('/')[1];
const module = sourcePathName.split('/')[2];
const subModule = sourcePathName.split('/')[3];

//console.log(`sourcePathName: ${sourcePathName}`);
//console.log(`section: ${section}`);
//console.log(`module: ${module}`);
//console.log(`subModule: ${subModule}`);

if (section === 'reports' && module === 'mif') {
    ax(
        {},
        '/axhelp/getCurrentUserData',
        function (data) {
            //console.log(data)
            const temp = new MifCompany(data);
        }
    )
}
