class AmsWPRest {
    constructor(postType, perPage,) {
        this.postType = postType;
        this.perPage = perPage;

        this.restUrl = window.location.origin + `/wp-json/wp/v2/${this.postType}/?per_page=${this.perPage}`;
        this.totalPages = 0;
        this.allResults = [];
    }

    get totalPagesCount() {
        return this.totalPages;
    }

    setTotalPageCount(count) {
        this.totalPages = count
    }

    get allPostResults() {
        return this.allResults;
    }

    setAllResults(moreResults) {
        this.allResults = this.allResults.concat(moreResults);
    }

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

}

export { AmsWPRest }