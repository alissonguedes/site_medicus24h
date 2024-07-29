var input_faixa_etaria = document.querySelector('input[name="faixa_etaria"]');
var value = input_faixa_etaria.value.split('-');
var slider = document.getElementById('faixa_etaria');

var formatForSlider = {
    from: function (formattedValue) {
        return Number(formattedValue);
    },
    to: function (numericValue) {
        return Math.round(numericValue);
    }
};

noUiSlider.create(slider, {
    start: [value[0] || 0, value[1] || 100],
    connect: true,
    step: 1,
    orientation: 'horizontal', // 'horizontal' or 'vertical'
    range: {
        'min': 0,
        'max': 120,
    },
    format: formatForSlider,
});

var snapValues = [
    document.getElementById('slider-snap-value-lower'),
    document.getElementById('slider-snap-value-upper')
];

slider.noUiSlider.on('update', function (values, handle) {

    snapValues[handle].innerHTML = values[handle];

    input_faixa_etaria.value = values[0] + ' - ' + values[1];

});


if (input_faixa_etaria.value != '') {

    slider.noUiSlider.set([value[0], value[1]]);

}
