var $antPage = $('#anotacoes-page');
var $cardsContainer = $('.aloc-cards .card .grid-muuri-line-cards');

initAnotacoesMuuri();

function initAnotacoesMuuri() {
    if(!$cardsContainer) return false;

    $cardsContainer.each(function (index, element) {
        let gridContainer = $(element);
        let muuriGrid = gridContainer.data('muuri');

        if(muuriGrid) {
            muuriGrid.destroy();
            muuriGrid = undefined;
        }

        muuriGrid = new Muuri(gridContainer[0], {
            items: '*',
            dragEnabled: true,
            dragAxis: 'y',
        });

        gridContainer.data('muuri', muuriGrid);
    });
}