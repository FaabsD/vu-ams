
/**
 * class AmsWPRest
 * @constructor
 * @param {string} postType - sets which posttype to retrieve from the built-in RestAPI
 * @param {integer} perPage - sets how many posts to retrieve per call max: 100.
 * @description A class to make it easier to retrieve (multiple) posts of a chosen posttype from WordPress's built-in RestAPI
 */
class AmsWPRest {
    constructor(postType, perPage,) {
        this.postType = postType;
        this.perPage = perPage;

        this.restUrl = window.location.origin + `/wp-json/wp/v2/${this.postType}/?per_page=${this.perPage}`;
        this.totalPages = 0;
        this.allResults = [];
    }

    /**
     * Get the total page count from the TotalPages property
     * @author Fabian Hendriks
     */
    get totalPagesCount() {
        return this.totalPages;
    }

    /**
     * Set the totalPages property to the total pages number retrieved from a first API call
     * @author Fabian Hendriks
     * @param {integer} count 
     */
    setTotalPageCount(count) {
        this.totalPages = count
    }

    /**
     * return an Array with all the results 
     * @author Fabian Hendriks
     */
    get allPostResults() {
        return this.allResults;
    }

    /**
     * Add more results to the allResults array
     * @author Fabian Hendriks
     * @param {array} moreResults - The resulting array to merge with allResults 
     * @description merges an array containing more results with the allResults Array
     */
    setAllResults(moreResults) {
        this.allResults = this.allResults.concat(moreResults);
    }

    /**
     * Make a call to the built-in RestAPI of WordPress
     * @Author: Fabian Hendriks
     * @Date: 2022-12-20 11:56:06 
     * @Desc: Uses fetch to make an API call to WordPress's built-in RestAPI and sets the page count
     * @param {int} page - Which page to fetch from
     */
    async makeRestCall(page = 0) {
        let response = await fetch(this.restUrl);

        if (page >= 2) {
            response = await fetch(this.restUrl + `&page=${page}`);
        }

        if (response.ok) {
            this.setTotalPageCount(response.headers.get('X-WP-TotalPages'));
            console.log(this.totalPagesCount);

            let postObjects = await response.json();
            return postObjects;
        }
        throw new Error(`An error has occurred while trying to fetch posts of type: ${this.postType} from the built REST API`);
    }

    /**
     * @author Fabian Hendriks
     * @description Fire multiple API calls to the WordPress built-in RestAPI. Useful when you want to retrieve all the post of the set type to use in front-end scripts
     */
    async makeMultipleRestCalls() {

        const callChain = await this.makeRestCall().then(results => {
            console.log('TEST TEST TEST');
            console.log(results);
            let chain = [];

            for (let i = 1; i <= this.totalPagesCount; i++) {
                console.log(this.totalPagesCount);
                console.log(i);
                chain.push(this.makeRestCall(i));
            }

            return chain;

        })

        const allPosts = await Promise.allSettled(callChain).then(responses => {

            responses.forEach(response => {
                console.log('PUTTING ALL RETRIEVED POSTS IN AN ARRAY...');
                console.log(response.value);
                this.setAllResults(response.value);
                console.log('NEW POSTS ARRAY');
                console.log(this.allPostResults);
            })

            return this.allPostResults;
        });

        return allPosts;
    }

}

export { AmsWPRest }