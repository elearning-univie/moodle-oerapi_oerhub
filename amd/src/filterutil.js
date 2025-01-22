const readFilter = () => {
    const selectedValues = Array.from(document.querySelectorAll('select.filterdata'))
        .reduce((values, select) => {
            const id = select.id;
            const selectedValue = select.value;

            // Skip adding if the related checkbox is unchecked
            if ((id === 'yearfrom' || id === 'yearto') && !document.getElementById(`${id}checkbox`).checked) {
                return values;
            }

            values[id] = selectedValue;
            return values;
        }, {});

    document.getElementById('filterdata').value = JSON.stringify(selectedValues);
};

const toggleDropdown = (checkboxId, dropdownId) => {
    const checkbox = document.getElementById(checkboxId);
    const dropdown = document.getElementById(dropdownId);

    if (checkbox && dropdown) {
        dropdown.disabled = !checkbox.checked;
    }
};

export const init = () => {
    const attachEvent = (selector, event, handler) => {
        const element = document.getElementById(selector);
        if (element) {
            element.addEventListener(event, handler);
        }
    };

    attachEvent('submitfilter', 'click', readFilter);

    attachEvent('perpage', 'change', function () {
        readFilter();
        this.form.submit();
    });

    attachEvent('yearfromcheckbox', 'click', () => toggleDropdown('yearfromcheckbox', 'yearfrom'));
    attachEvent('yeartocheckbox', 'click', () => toggleDropdown('yeartocheckbox', 'yearto'));
};
