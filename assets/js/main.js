$(document).ready(function () {

    let filterOptions = [
        // {'filterKey': 'class', 'filterValue': 'hunter', 'filterInvert': true, 'filterActive': true},
        // {'filterKey': 'race', 'filterValue': 'beast', 'filterInvert': true, 'filterActive': true},
    ];

    let RACES = [
        'Beast',
        'Demon',
        'Dragon',
        'Dwarf',
        'Element',
        'Elf',
        'Goblin',
        'Human',
        'Naga',
        'Ogre',
        'Orc',
        'Troll',
        'Undead',
    ];

    let CLASSES = [
        'Assassin',
        'Demon Hunter',
        'Druid',
        'Hunter',
        'Knight',
        'Mage',
        'Mech',
        'Shaman',
        'Warlock',
        'Warrior',
    ];

    let RARITY = [
        'Common',
        'Uncommon',
        'Rare',
        'Epic',
        'Legendary',
    ];

    let COSTS = ["1", "2", "3", "4", "5"];


    function capFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    function resetList() {
        $('.chess-piece-card').each(function () {
            let pieceData = {
                'name': $(this).data("name"),
                'race': $(this).data("race"),
                'class': $(this).data("class"),
                'rarity': $(this).data("rarity"),
                'cost': $(this).data("cost"),
            };
            // console.log(pieceData);

            let active = true;
            filterOptions.forEach(function (filter) {

                if (filter['filterActive'] && filter['filterValue'] !== '') {

                    let pattPrefix = (filter['filterKey'] !== 'race')?'^':'';
                    let pattern = new RegExp(pattPrefix+filter['filterValue'],"igm");
                    let stringValue = pieceData[filter['filterKey']].toString();
                    let result = stringValue.match(pattern);
                    // if (pieceData[filter['filterKey']].toString().indexOf(filter['filterValue']) < 0) active = false;
                    // console.log(pattern,stringValue,result);
                    if(result == null) active = false;
                }
            });
            if (active) {
                // console.log(pieceData);
                // $(this).css('display','table-row');
                $(this).parent().css('display', 'block');
            } else {
                // $(this).css('display','none');
                $(this).parent().css('display', 'none');
            }
        });
    }

    function resetFilterList() {
        let filterListElement = $('#filterOptions').first();
        $('#filterOptions li').remove();

        for (let i = 0; i < filterOptions.length; i++) {

            let filter = filterOptions[i];
            let constValues = [];

            switch (filter['filterKey']) {
                case 'race':
                    constValues = RACES;
                    break;
                case 'class':
                    constValues = CLASSES;
                    break;
                case 'rarity':
                    constValues = RARITY;
                    break;
                case 'cost':
                    constValues = COSTS;
                    break;
            }

            let optionsHTML = '';
            constValues.forEach(function (element, i) {
                let escapedValue = element.toLowerCase().replace(' ', '-');
                optionsHTML += `<div class="item" data-value="${element.toLowerCase()}">${element}</div>`;
            });

            filterListElement.append(`
            <li>
                
                <div class="ui grid">
                    <div class="three wide column">${capFirstLetter(filter['filterKey'])}</div>
                    <div class="eleven wide column">
                        <div class="ui fluid search selection dropdown filter-option-select" data-filter-id="${i}">
                            <input type="hidden" value="${filter['filterValue']}">
                            <i class="dropdown icon"></i>
                            <div class="default text">${filter['filterKey'].toLocaleUpperCase()}</div>
                            <div class="menu">
                                ${optionsHTML}
                            </div>
                        </div>
                    </div>
                    <div class="two wide column">
                        <button class="ui inverted icon button remove-btn" data-filter-id="${i}">
                            <i class="close icon"></i>
                        </button>
                    </div>
                </div>
            </li>
            `);
        }

        $('.remove-btn').click(function (e) {
            e.preventDefault();

            let filterOptionID = $(this).data('filterId');
            filterOptions.splice(filterOptionID,1);
            resetFilterList();
        });

        $('.filter-option-select').dropdown({
            onChange: function (e, t, g) {

                let filterID = $(this).data("filterId");

                filterOptions[filterID]['filterValue'] = e;
                resetList();
            }
        });

        // $('.filter-active-checkbox').each().checkbox({
        //     onChange: function () {
        //          console.log("Hello World");
        //     }
        // });

        // console.log(filterOptions);
        resetList();
    }

    resetFilterList();

    // $('.filter-value-select').on('change', function (e) {
    //     console.log(filterOptions);
    //     let filterId = $(this).data('filterId');
    //     filterOptions[filterId]['filterValue'] = $(this).val();
    //     console.log(filterOptions);
    //     resetList();
    // });


    // $('.btn-list').click(function (e) {
    //     e.preventDefault();
    //
    //     if (!$(this).hasClass('active')) {
    //         $('.btn-cards').toggleClass('active');
    //         $(this).toggleClass('active');
    //
    //         $('.chess-pieces-list').toggleClass('hiddenList');
    //         $('.chess-pieces-cards').toggleClass('hiddenList');
    //     }
    // });
    //
    // $('.btn-cards').click(function (e) {
    //     e.preventDefault();
    //
    //     if (!$(this).hasClass('active')) {
    //         $('.btn-list').toggleClass('active');
    //         $(this).toggleClass('active');
    //
    //         $('.chess-pieces-list').toggleClass('hiddenList');
    //         $('.chess-pieces-cards').toggleClass('hiddenList');
    //     }
    // });

    // $('.filter-active-checkbox').click(function (e) {
    //     console.log(e);
    //     $(this).parent().children('.ui.grid').toggleClass('active');
    //     filterOptions[$(this).data('filterId')]['filterActive'] = !filterOptions[$(this).data('filterId')]['filterActive'];
    //     resetList();
    // });


    $('#filterOptionsDropdown').dropdown({
        action: 'hide',
        onChange: function (e, t, g) {
            filterOptions.push({'filterKey': e, 'filterValue': '', 'filterInvert': true, 'filterActive': true});
            // console.log(filterOptions);
            resetFilterList();
        },
    });

    $('.class-popup-parent').popup({
        inline: true,
    });
});



