const onurl = 'https://www.pasangbaliho.com';

export async function loadKategori () {
    let data = 0;
    try {
        let res = await axios.get(onurl+'/adminapi/kategori/request');
        data = res.data;
    } catch (error) {
        alert(error)
    }
    return data;
}