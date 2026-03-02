const https = require('https');

https.get('https://www.denimsa.com.tr/koleksiyon', (resp) => {
    let data = '';
    resp.on('data', (chunk) => { data += chunk; });
    resp.on('end', () => {
        const regex = /<div class="col-lg-4 col-sm-6 wow fadeInUp".*?href="([^"]+)".*?src="([^"]+)".*?<h4[^>]*>(.*?)<\/h4>/gis;
        let match;
        let index = 1;
        let sql = "SET NAMES utf8mb4;\nTRUNCATE TABLE collection_categories;\n";

        while ((match = regex.exec(data)) !== null) {
            let link = "https://www.denimsa.com.tr" + match[1].trim();
            let img = "https://www.denimsa.com.tr" + match[2].trim();
            let title = match[3].trim();

            sql += `INSERT INTO collection_categories (title_tr, title_en, description_tr, description_en, cover_image, video_url, is_active, order_num) VALUES ('${title}', '${title} (EN)', 'Premium ${title} serisi.', 'Premium ${title} series.', '${img}', '${link}', 1, ${index});\n`;
            index++;
        }

        // Add default Temper style video to settings
        sql += "UPDATE site_settings SET hero_video_url = 'https://www.tempertekstil.com.tr/assets/video/intro.mp4' WHERE id = 1;\n";

        const fs = require('fs');
        fs.writeFileSync('c:/Users/aliko/denimsa/seed.sql', sql, 'utf8');
        console.log("Seed SQL generated.");
    });
}).on("error", (err) => {
    console.log("Error: " + err.message);
});
