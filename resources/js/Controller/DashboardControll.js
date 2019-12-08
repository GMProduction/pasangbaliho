export async function dashboardAPI (apiURL) {
    try {
        let res = await axios.get(apiURL);
        return {data: res,
            statusdata: 'success'}
    } catch (error) {
        return {
            statusdata: 'error',
            data: error
        }
    }
}
