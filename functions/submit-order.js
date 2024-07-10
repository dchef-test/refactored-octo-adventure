const fetch = require('node-fetch');

exports.handler = async (event, context) => {
    if (event.httpMethod !== 'POST') {
        return {
            statusCode: 405,
            body: 'Method Not Allowed',
        };
    }

    const data = JSON.parse(event.body);
    const { address, phone, notes } = data;

    const webhookUrl = 'https://discord.com/api/webhooks/1260378849225605214/mHW_ENJx7TbTLJH6pQ70kaC7u2UPx43M4Yufa5TzLWeiooPiij3owzrw-_tqOvldjvXJ';

    const discordData = {
        content: `New Order Details:\n**Address:** ${address}\n**Phone:** ${phone}\n**Notes:** ${notes}`,
    };

    try {
        await fetch(webhookUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(discordData),
        });

        return {
            statusCode: 200,
            body: 'Order details sent successfully to Discord!',
        };
    } catch (error) {
        return {
            statusCode: 500,
            body: `Error: ${error.toString()}`,
        };
    }
};
