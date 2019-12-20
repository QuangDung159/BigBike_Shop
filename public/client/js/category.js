function doSortProductByCategory(categoryId, brandId) {
    let sortType = $("#sort_type").val();
    let itemPerPage = $("#item_per_page").val();

    let data = {
        'sort_type': sortType,
        'item_per_page': itemPerPage
    };

    let url = encodeQueryData(data);
    window.location.href = '/category/' + categoryId + '/' + brandId + '?' + url;
}

function encodeQueryData(data) {
    const ret = [];
    for (let d in data)
        ret.push(encodeURIComponent(d) + '=' + encodeURIComponent(data[d]));
    return ret.join('&');
}
