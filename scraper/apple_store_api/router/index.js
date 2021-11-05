const express = require('express');
const appstore = require('app-store-scraper');

const router = express.Router();

router.get("/apps/:appId", (req, res, next) => {
    const appId = req.params.appId;
    appstore.app({id: appId, lang:'ja'})
    .then(res.json.bind(res))
    .catch(next);
});

function errorHandler (err, req, res, next) {
    res.status(400).json({message: err.message});
    next();
}
  
router.use(errorHandler);
  
module.exports = router;
