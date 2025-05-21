//para sa checkboxes ng add-student.php

    function toggleCheckboxes(selectAll) {
        const checkboxes = document.querySelectorAll('.course-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = selectAll.checked;
        });
    }
