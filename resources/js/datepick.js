import DateRangePicker from 'flowbite-datepicker/DateRangePicker';
const dateRangePickerEl = document.getElementById('dateRangePickerId');
new DateRangePicker(dateRangePickerEl, {
    format: "dd-mm-yyyy"
});
