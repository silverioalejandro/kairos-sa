const { isBoolean } = require("lodash");

const getStatusView = (getDatatableView, options, headers) => {
    let data = {
        page: 1,
        options: {
            sortBy: options.sortBy,
            sortDesc: options.sortDesc
        },
        filters: null,
        headers
    }

    if(getDatatableView == undefined) return data;

    data["headers"] = (getDatatableView.headers == undefined) ? headers : getDatatableView.headers;

    data["filters"] =
        (getDatatableView.filters == undefined)
            ? null
            : Object.assign({}, getDatatableView.filters);

    data["page"] = (getDatatableView.page == undefined) ? 1 : getDatatableView.page;

    if (getDatatableView.sort == null) return data;

    data["options"] = {
        sortBy: getDatatableView.sort.sortBy,
        sortDesc: getDatatableView.sort.sortDesc,
    };

    return data;
}

const initializeParameters = (getDatatableView, page, options) => {
    let data = {
        page: page,
        sortBy: options.sortBy,
        sortDesc: options.sortDesc
    }

    if (getDatatableView != undefined && getDatatableView.filters != undefined) {
        data["filterBy"] = Object.keys(getDatatableView.filters);
        data["filterValues"] = Object.values(getDatatableView.filters);
    }

    return data;
}

const pageDetails = data => {
	return {
        data: data.data,
        first_page_url: data.first_page_url,
        from: data.from,
        last_page: data.last_page,
        per_page: data.per_page,
        prev_page_url: data.prev_page_url,
        to: data.to,
        total: data.total,
    };
}

const descriptionFiltered = filters => {
    const descriptions = Object.assign({}, filters);
    if(!descriptions) return null;

    return Object.keys(descriptions)
        .map((e) => {
            return { name: e, value: descriptions[e] };
        })
        .filter((item) => {
            if(isBoolean(item.value)) return true
            if (item.value == null) return false;

            let newValue = item.value;
            if (Number.isInteger(newValue)) newValue = String(newValue);

            return newValue.length > 0;
        });
}

const descriptionFilterOption = (optionSelected, listArry) => {
    const list = listArry
        .filter((item) => {
            const key = item.id == undefined ? item.value: item.id;
            return optionSelected.includes(key);

        }, optionSelected)
        .map(({ name }) => name)
        .join(" - ");
    return `[ ${list} ]`;
}

const currentFilter = (filters, multipleSelectionFields = []) => {
        Object.filter = (obj, predicate) =>
        Object.fromEntries(Object.entries(obj).filter(predicate));

        let filtered = Object.filter(filters, ([name, value]) => {
            if(isBoolean(value)) return true;
            if (Array.isArray(value)) return value.length > 0;
            return value != null && value != "";
        });

        for (let item of multipleSelectionFields) {
            if(!filtered[item] && ![multipleSelectionFields].includes(filtered[item])){
                continue;
            }

            if(Array.isArray(filtered[item])){
                continue;
            }

            filtered[item] = filtered[item].split(',');
        }

        return filtered;
}

module.exports = {
    getStatusView,
    initializeParameters,
    pageDetails,
    descriptionFiltered,
    descriptionFilterOption,
    currentFilter
}
