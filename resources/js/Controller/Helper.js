export const dateFormater = (date) => {
    const tempDate = date.split('-');
    return tempDate[2]+'/'+tempDate[1]+'/'+tempDate[0]
}