var emSignerConfig = {
    cancelled: 'signing canceled',
    formSignParam: 'emsigneraction=sign\nsignaction=sign\nfilepath=\npanNumberParam=\nexpirycheck=false\nissuername=\ncertclass=1|2|3\ncerttype=ALL\ndatatosign={{DATA}}',
    fileSignParam: "emsigneraction=pdfsign\ntbs={{FSRC}}\noutputpath={{FDEST}}\nsignaction=3\ncerttype=ALL\nexpirycheck=true\nissuername=\nsigntype=detached\ncoordinate=100,700,200,750\npageno=all\nreason=OAS\nlocation=100,700,200,750"
};
var ListeningPort = 8080;
var PortList = [8080, 1645, 1812, 2083, 2948];
var connection;
var errorCount = 0;
var index = 0;

function SetConnectionPort(port) {
    index++;
    if ("WebSocket" in window) {
        setTimeout(function () {
            var ws = new WebSocket("wss://127.0.0.1:" + port);
            ws.onopen = function () {
                console.log('Connection Opened');
                connection = ws;
            };
            ws.onerror = function (err) {
                errorCount++;
                if (index == 5 && errorCount == 5) {
                    alert("Signer seems like not running, Pleae make sure signer is running.");
                    //failedToConnect();
                }
            };

        }, 1);
    }
}

function startConnection() {
    for (var i = 0; i < PortList.length; i++) {
        if (connection && connection.readyState < 2) {
            console.log('connection ok..');
            break;
        }
        SetConnectionPort(PortList[i]);
    }
}

function signer(param, conn) {
    return new Promise(function (resolve, reject) {
        if (conn && conn.readyState < 2) {
            conn.send(param);
            conn.onmessage = function (e) {
                var resp = e.data;
                resolve(resp);
            };
            conn.onerror = function (err) {
                console.log('error on signing');
                reject(err);
            };
        } else {
            reject('Connection to server not available.');
        }
    });
}

function signForm(msg, conn) {
    var msgTxt = emSignerConfig.formSignParam.replace('{{DATA}}', msg);
    return signer(msgTxt, conn);
}

function signPdfFile(fileUrl, outputFileUrl, conn) {
    var outputFile = outputFileUrl || '';
    var signParams = emSignerConfig.fileSignParam.replace('{{FSRC}}', fileUrl).replace('{{FDEST}}', outputFile);
    return signer(signParams, conn);
}

function runSigner() {
    signForm('Hello', connection).then(function (data) {
        console.log(data);
    }).catch(function (err) {
        console.log(err);
    });
}


function processFormSubmit(url, formId, conn, ds) {
    return new Promise(function (resolve, reject) {
        if (ds) {
            if (typeof conn == 'undefined') {
                return reject('Please make sure signer is running correctly.');
            }
            var dsdata = readSignatureSeq($('#sig_seq').val());
            //console.log(dsdata);
            signForm(dsdata, conn).then(function (data) {
                if (emSignerConfig.cancelled == data) {
                    return reject('Cancelled the signing process.');
                }
                $('#dig_sig').val(data);
                var formData = $("#" + formId).serialize();
                var xhr = submitFormAjax(url, formData);
                xhr.done(function (resp) {
                    resolve(resp);
                }).fail(function (err) {
                    reject(err.responseJSON);
                });
            }).catch(function (err) {
                reject(err);
            });
        } else {
            var formData = $("#" + formId).serialize();
            var xhr = submitFormAjax(url, formData);
            xhr.done(function (resp) {
                resolve(resp);
            }).fail(function (err) {
                reject(err.responseJSON);
            });
        }
    });
}



