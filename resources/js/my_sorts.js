import Sortable from 'sortablejs';

var sortableOptions2 = {
    group: {
        pull: true,
        put: true,
    },
    animation: 250,
    forceFallback: true,
    onEnd: function (evt) {
        var current = evt.item;  // dragged HTMLElement
        var nextList = evt.to;
        var action = '';
        var rows = nextList.querySelectorAll(".list-group-item");
        var prevItem = rows[evt.newIndex - 1];
        var nextItem = rows[evt.newIndex + 1];
        var currentID = current.getAttribute("data-category-id");
        var data = null;
        if ((prevItem) === undefined) {
            action = "before";
            data = {"currentID": currentID, "nextID": nextItem.getAttribute("data-category-id"), "_token": $('meta[name="csrf-token"]').attr('content')};
        } else {
            action = "after";
            data = {"currentID": currentID, "prevID": prevItem.getAttribute("data-category-id"), "_token": $('meta[name="csrf-token"]').attr('content')};
        }
        $.ajax({
            type: 'POST',
            url: '/category/resort',
            data: data,
            success: function (data) {
                console.log(data);
            }
        });
    },

};

var lists = document.querySelectorAll(".list-group");
for (var i = 0; i < lists.length; i++) {
    new Sortable(lists[i], sortableOptions2);
}
