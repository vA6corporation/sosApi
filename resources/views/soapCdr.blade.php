<soapenv:Envelope 
    xmlns:ser="http://service.sunat.gob.pe" 
    xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" 
    xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
    
    <soapenv:Header>
      <wsse:Security>
        <wsse:UsernameToken>
        <wsse:Username>{{ $ruc }}{{ $usuarioSol }}</wsse:Username>
        <wsse:Password>{{ $claveSol }}</wsse:Password>
        </wsse:UsernameToken>
      </wsse:Security>
    </soapenv:Header>
    
    <soapenv:Body>
      <ser:getStatusCdr>
        <rucComprobante>{{ $ruc }}</rucComprobante>
        <tipoComprobante>{{ $serie[0] == 'F' ? '01' : '03' }}</tipoComprobante>
        <serieComprobante>{{ $serie }}</serieComprobante>
        <numeroComprobante>{{ $correlativo }}</numeroComprobante>
      </ser:getStatusCdr>
    </soapenv:Body>
  
  </soapenv:Envelope>