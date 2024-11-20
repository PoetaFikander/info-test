"use strict";
console.log('module users start');

import {ax} from "../f.js";

import {
    UsersList,
} from "./users-f.js";

const sourcePathName = window.location.pathname;
const section = sourcePathName.split('/')[1];
const module = sourcePathName.split('/')[2];
const subModule = sourcePathName.split('/')[3];

//console.log(`sourcePathName: ${sourcePathName}`);
//console.log(`section: ${section}`);
//console.log(`module: ${module}`);
//console.log(`subModule: ${subModule}`);

if (section === 'users') {
    ax(
        {},
        '/axhelp/getDataForUsersList',
        function (data) {
            //console.log(data)
            const uu = new UsersList(data);
        }
    )
}
