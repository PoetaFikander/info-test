"use strict";
import {$overlaySpinner} from "../c.js";

console.log('module reports start');

import {fx, ax} from "../f.js";

import {
    CustomersCostsAndProfits,
    CustomersList,
    MifCompany,
    DevicesList,
    WorkCardsList,
} from "./reports-f.js";
import {DynamicTablesList} from "../it/it-f.js";

const sourcePathName = window.location.pathname;
const section = sourcePathName.split('/')[1];
const module = sourcePathName.split('/')[2];
const subModule = sourcePathName.split('/')[3];
//const id = parseInt(sourcePathName.split('/')[4]);

// console.log(`sourcePathName: ${sourcePathName}`);
// console.log(`section: ${section}`);
// console.log(`module: ${module}`);
// console.log(`subModule: ${subModule}`);

if (section === 'reports' && module === 'mif') {
    const temp = new MifCompany({});
}

if (section === 'reports' && module === 'cust' && subModule === undefined) {
    const temp = new CustomersList({});
}

if (section === 'reports' && module === 'cust' && (subModule === 'cap-full' || subModule === 'cap-limited')) {
    const temp = new CustomersCostsAndProfits({});
}

if (section === 'reports' && module === 'dev' && subModule === undefined) {
    const temp = new DevicesList({});
}

if (section === 'reports' && module === 'wc' && subModule === undefined) {
    //const temp = new WorkCardsList({});
    (async () => {
        $overlaySpinner.fadeIn(300);
        const [
            table,
        ] = await Promise.all([
            fx('/axhelp/getDynamicTable', {id: 1, name: 'tableWcList'}),
        ]);
        const temp = new WorkCardsList({
            table: table,
        });
        $overlaySpinner.fadeOut(300);
    })();

}
