// Map Color Shading According To Visits
const stateLinks = document.querySelectorAll('#regional_map .model-green .state');

let districtVisits = {};
let totalVisits = 0;

// Normalize district name to lowercase
const normalizeName = name => name ? name.toLowerCase() : '';

// Count visits for each district and total visits
allVisits.customerVisits.forEach(visit => {
    const districtName = normalizeName(visit.city ? visit.city.name : '');
    if (!districtVisits[districtName]) {
        districtVisits[districtName] = 0;
    }
    districtVisits[districtName]++;
    totalVisits++;
});

allVisits.protocolLiaisons.forEach(visit => {
    const districtName = normalizeName(visit.city ? visit.city.name : (visit.company_city ?? ''));
    if (!districtVisits[districtName]) {
        districtVisits[districtName] = 0;
    }
    districtVisits[districtName]++;
    totalVisits++;
});

stateLinks.forEach(link => {
    const districtName = normalizeName(link.id.split("_").filter(part => part !== "state").join(" "));
    const visits = districtVisits[districtName] || 0;
    const proportion = (visits / totalVisits) * 100;

    link.classList.remove('level-1', 'level-2', 'level-3', 'level-4', 'level-5', 'level-6', 'level-7', 'level-8', 'level-9', 'level-10');

    if (proportion > 90) {
        link.classList.add('level-10');
    } else if (proportion > 80) {
        link.classList.add('level-9');
    } else if (proportion > 70) {
        link.classList.add('level-8');
    } else if (proportion > 60) {
        link.classList.add('level-7');
    } else if (proportion > 50) {
        link.classList.add('level-6');
    } else if (proportion > 40) {
        link.classList.add('level-5');
    } else if (proportion > 30) {
        link.classList.add('level-4');
    } else if (proportion > 20) {
        link.classList.add('level-3');
    } else if (proportion > 10) {
        link.classList.add('level-2');
    } else if (proportion > 0) {
        link.classList.add('level-1');
    }

});

if (moduleName == "GUEST") {
    // Map Color Shading According To Visits
    const stateLinks = document.querySelectorAll('#listing_map .model-green .state');

    let districtVisits = {};
    let totalVisits = 0;

    // Normalize district name to lowercase
    const normalizeName = name => name ? name.toLowerCase() : '';

    // Count visits for each district and total visits
    guests.forEach(visit => {
        const districtName = normalizeName(visit.city ? visit.city.name : '');
        if (!districtVisits[districtName]) {
            districtVisits[districtName] = 0;
        }
        districtVisits[districtName]++;
        totalVisits++;
    });

    stateLinks.forEach(link => {
        const districtName = normalizeName(link.id.split("_").filter(part => part !== "state").join(" "));
        const visits = districtVisits[districtName] || 0;
        const proportion = (visits / totalVisits) * 100;

        link.classList.remove('level-1', 'level-2', 'level-3', 'level-4', 'level-5', 'level-6', 'level-7', 'level-8', 'level-9', 'level-10');

        if (proportion > 90) {
            link.classList.add('level-10');
        } else if (proportion > 80) {
            link.classList.add('level-9');
        } else if (proportion > 70) {
            link.classList.add('level-8');
        } else if (proportion > 60) {
            link.classList.add('level-7');
        } else if (proportion > 50) {
            link.classList.add('level-6');
        } else if (proportion > 40) {
            link.classList.add('level-5');
        } else if (proportion > 30) {
            link.classList.add('level-4');
        } else if (proportion > 20) {
            link.classList.add('level-3');
        } else if (proportion > 10) {
            link.classList.add('level-2');
        } else if (proportion > 0) {
            link.classList.add('level-1');
        }

    });
}