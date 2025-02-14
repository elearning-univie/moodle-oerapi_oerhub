import {getString} from 'core/str';

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

    // If both year values are present, perform date validation.
    if (selectedValues.yearfrom && selectedValues.yearto) {
        if (selectedValues.yearfrom > selectedValues.yearto) {
            const errorDiv = document.getElementById('yeartofilter');
            if (errorDiv) {
                if (!errorDiv.querySelector('.date-error')) {
                    const errorMsg = document.createElement('p');
                    errorMsg.classList.add('date-error');
                    getString('dateerror', 'oerapi_oerhub').then((infomessage) => {
                        errorMsg.textContent = infomessage;
                        errorDiv.appendChild(errorMsg);
                    });
                }
            }
            return false;
        }
    }

    // If validation passes, clear any existing error message.
    const errorDiv = document.getElementById('yeartofilter');
    if (errorDiv) {
        const existingError = errorDiv.querySelector('.date-error');
        if (existingError) {
            existingError.remove();
        }
    }

    document.getElementById('filterdata').value = JSON.stringify(selectedValues);
    return true;
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

    attachEvent('submitfilter', 'click', function(e) {
        if (!readFilter()) {
            e.preventDefault();
        }
    });

    attachEvent('perpage', 'change', function () {
        if (readFilter()) {
            this.form.submit();
        }
    });

    attachEvent('yearfromcheckbox', 'click', () => toggleDropdown('yearfromcheckbox', 'yearfrom'));
    attachEvent('yeartocheckbox', 'click', () => toggleDropdown('yeartocheckbox', 'yearto'));
};
