<?xml version="1.0" encoding="utf-8"?>
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="https://www.w3.org/2001/XMLSchema-instance">
    <soapenv:Header>
        <ebl:RequesterCredentials soapenv:mustUnderstand="0"
                                  xmlns:ns="urn:ebay:apis:eBLBaseComponents" xmlns:ebl="urn:ebay:apis:eBLBaseComponents">
            <ebl:NotificationSignature
                xmlns:ebl="urn:ebay:apis:eBLBaseComponents">AKurONibBT6zkNCsQ27rtg==
            </ebl:NotificationSignature>
        </ebl:RequesterCredentials>
    </soapenv:Header>
    <soapenv:Body>
        <GetItemTransactionsResponse xmlns="urn:ebay:apis:eBLBaseComponents">
            <Timestamp>2005-04-27T17:48:03.545Z</Timestamp>
            <Ack>Success</Ack>
            <CorrelationID>00000000-00000000-00000000-00000000-00000000-00000000-0000000000
            </CorrelationID>
            <Version>407</Version>
            <Build>20050426141851</Build>
            <NotificationEventName>AuctionCheckoutComplete</NotificationEventName>
            <PaginationResult>
                <TotalNumberOfPages>1</TotalNumberOfPages>
                <TotalNumberOfEntries>1</TotalNumberOfEntries>
            </PaginationResult>
            <HasMoreTransactions>false</HasMoreTransactions>
            <TransactionsPerPage>100</TransactionsPerPage>
            <PageNumber>1</PageNumber>
            <ReturnedTransactionCountActual>1</ReturnedTransactionCountActual>
            <Item>
                <AutoPay>false</AutoPay>
                <BuyerProtection>ItemIneligible</BuyerProtection>
                <Currency>USD</Currency>
                <ItemID>2211777403</ItemID>
                <ListingType>Chinese</ListingType>
                <PaymentMethods>PaymentSeeDescription</PaymentMethods>
                <PrivateListing>true</PrivateListing>
                <Quantity>1</Quantity>
                <Seller>
                    <AboutMePage>true</AboutMePage>
                    <EIASToken>nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6wJnY+gD5iFoA+dj6x9nY+seQ==</EIASToken>
                    <Email>sampleseller@sampleseller.com</Email>
                    <FeedbackScore>4119</FeedbackScore>
                    <FeedbackRatingStar>Red</FeedbackRatingStar>
                    <IDVerified>true</IDVerified>
                    <NewUser>false</NewUser>
                    <RegistrationDate>2004-10-03T18:28:52.000Z</RegistrationDate>
                    <Site>US</Site>
                    <Status>Confirmed</Status>
                    <UserID>sampleseller</UserID>
                    <UserIDChanged>false</UserIDChanged>
                    <UserIDLastChanged>2001-01-19T17:21:01.000Z</UserIDLastChanged>
                    <SellerInfo>
                        <AllowPaymentEdit>true</AllowPaymentEdit>
                        <CheckoutEnabled>true</CheckoutEnabled>
                        <CIPBankAccountStored>false</CIPBankAccountStored>
                        <GoodStanding>true</GoodStanding>
                        <MerchandizingPref>OptIn</MerchandizingPref>
                        <QualifiesForB2BVAT>false</QualifiesForB2BVAT>
                        <SellerLevel>None</SellerLevel>
                        <StoreOwner>true</StoreOwner>
                        <StoreURL>http://www.ebaystores.ebay.com/id=178713</StoreURL>
                    </SellerInfo>
                </Seller>
                <SellingStatus>
                    <ConvertedCurrentPrice currencyID="USD">100.0</ConvertedCurrentPrice>
                    <CurrentPrice currencyID="USD">100.0</CurrentPrice>
                    <QuantitySold>1</QuantitySold>
                </SellingStatus>
                <Site>US</Site>
                <Title>GetItem Test</Title>
            </Item>
            <TransactionArray>
                <Transaction>
                    <AmountPaid currencyID="USD">100.0</AmountPaid>
                    <AdjustmentAmount currencyID="USD">0.0</AdjustmentAmount>
                    <ConvertedAdjustmentAmount currencyID="USD">0.0</ConvertedAdjustmentAmount>
                    <Buyer>
                        <AboutMePage>false</AboutMePage>
                        <EIASToken>nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6wJnY+gD5iFogidj6x9nY+seQ==</EIASToken>
                        <Email>samplebuyer@samplebuyer.com</Email>
                        <FeedbackScore>58</FeedbackScore>
                        <FeedbackRatingStar>Blue</FeedbackRatingStar>
                        <IDVerified>true</IDVerified>
                        <NewUser>false</NewUser>
                        <RegistrationDate>1999-01-19T08:00:00.000Z</RegistrationDate>
                        <Site>US</Site>
                        <Status>Confirmed</Status>
                        <UserID>samplebuyer</UserID>
                        <UserIDChanged>false</UserIDChanged>
                        <UserIDLastChanged>2001-01-19T18:42:14.000Z</UserIDLastChanged>
                        <BuyerInfo>
                            <ShippingAddress>
                                <Name>new_Name</Name>
                                <Street1>a new street1</Street1>
                                <Street2>new street 2</Street2>
                                <CityName>my new town</CityName>
                                <StateOrProvince>CA</StateOrProvince>
                                <Country>US</Country>
                                <CountryName>United States</CountryName>
                                <Phone>(111) 111-1</Phone>
                                <PostalCode>95555</PostalCode>
                                <AddressID>191925</AddressID>
                                <AddressOwner>eBay</AddressOwner>
                            </ShippingAddress>
                        </BuyerInfo>
                    </Buyer>
                    <ShippingDetails>
                        <ChangePaymentInstructions>true</ChangePaymentInstructions>
                        <InsuranceFee currencyID="USD">0.0</InsuranceFee>
                        <InsuranceOption>NotOffered</InsuranceOption>
                        <InsuranceWanted>false</InsuranceWanted>
                        <PaymentEdited>false</PaymentEdited>
                        <SalesTax>
                            <SalesTaxPercent>0.0</SalesTaxPercent>
                            <ShippingIncludedInTax>false</ShippingIncludedInTax>
                        </SalesTax>
                        <ShippingServiceOptions>
                            <ShippingService>ShippingMethodStandard</ShippingService>
                            <ShippingServiceCost currencyID="USD">0.0</ShippingServiceCost>
                            <ShippingServiceAdditionalCost currencyID="USD">0.0
                            </ShippingServiceAdditionalCost>
                            <ShippingServicePriority>1</ShippingServicePriority>
                        </ShippingServiceOptions>
                    </ShippingDetails>
                    <ConvertedAmountPaid currencyID="USD">100.0</ConvertedAmountPaid>
                    <ConvertedTransactionPrice currencyID="USD">100.0</ConvertedTransactionPrice>
                    <CreatedDate>2005-04-09T01:27:52.000Z</CreatedDate>
                    <DepositType>None</DepositType>
                    <QuantityPurchased>1</QuantityPurchased>
                    <Status>
                        <eBayPaymentStatus>NoPaymentFailure</eBayPaymentStatus>
                        <CheckoutStatus>CheckoutComplete</CheckoutStatus>
                        <LastTimeModified>2005-04-27T17:46:04.000Z</LastTimeModified>
                        <PaymentMethodUsed>PaymentSeeDescription</PaymentMethodUsed>
                        <CompleteStatus>Complete</CompleteStatus>
                    </Status>
                    <TransactionID>4950</TransactionID>
                    <TransactionPrice currencyID="USD">100.0</TransactionPrice>
                    <BestOfferSale>false</BestOfferSale>
                    <ShippingServiceSelected>
                        <ShippingInsuranceCost currencyID="USD">0.0</ShippingInsuranceCost>
                        <ShippingService>ShippingMethodStandard</ShippingService>
                        <ShippingServiceCost currencyID="USD">0.0</ShippingServiceCost>
                    </ShippingServiceSelected>
                </Transaction>
            </TransactionArray>
            <PayPalPreferred>true</PayPalPreferred>
        </GetItemTransactionsResponse>
    </soapenv:Body>
</soapenv:Envelope>
