"use strict";
import {$overlaySpinner} from "../c.js";

console.log('module reports start');

import {fx, ax} from "../f.js";

import {
    CustomersCostsAndProfits,
    CustomersList,
    MifCompany,
} from "./reports-f.js";

const sourcePathName = window.location.pathname;
const section = sourcePathName.split('/')[1];
const module = sourcePathName.split('/')[2];
const subModule = sourcePathName.split('/')[3];
//const id = parseInt(sourcePathName.split('/')[4]);

console.log(`sourcePathName: ${sourcePathName}`);
console.log(`section: ${section}`);
console.log(`module: ${module}`);
console.log(`subModule: ${subModule}`);

if (section === 'reports' && module === 'mif') {
    (async () => {
        $overlaySpinner.fadeIn(300);
        const [
            currentUserData,
        ] = await Promise.all([
            fx('/axhelp/getCurrentUserData'),
        ]);
        const temp = new MifCompany({
            currentUserData: currentUserData,
        });
        $overlaySpinner.fadeOut(300);
    })();
}

if (section === 'reports' && module === 'cust' && subModule === undefined) {
    (async () => {
        $overlaySpinner.fadeIn(300);
        const [
            currentUserData,
        ] = await Promise.all([
            fx('/axhelp/getCurrentUserData'),
        ]);
        const temp = new CustomersList({
            currentUserData: currentUserData,
        });
        $overlaySpinner.fadeOut(300);
    })();
}


if (section === 'reports' && module === 'cust' && (subModule === 'cap-full' || subModule === 'cap-limited')) {
    (async () => {
        $overlaySpinner.fadeIn(300);
        const [
            currentUserData,
        ] = await Promise.all([
            fx('/axhelp/getCurrentUserData'),
        ]);
        const temp = new CustomersCostsAndProfits({
            currentUserData: currentUserData,
        });
        $overlaySpinner.fadeOut(300);
    })();
}
