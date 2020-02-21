export const dateFormater = (date) => {
    const tempDate = date.split('-');
    return tempDate[2]+'/'+tempDate[1]+'/'+tempDate[0]
}

export const  formatAngka = (x)  =>{
    if (x === undefined || x === null) {
        return '0'
    }
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

export const dateTimeFormater = (date) => {
    if (date !== undefined || date !== null) {
        var d = new Date(date);
        return d.getDate() + '/' +d.getMonth()+'/'+d.getFullYear();
    }
    return ''
}