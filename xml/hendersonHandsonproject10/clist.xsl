<?xml version="1.0" encoding="UTF-8" ?>
<!--
   The Spice Bowl XSLT Style Sheet
   Author: Eric Henderson
   Date: 12/1/25

   Filename:         clist.xsl
   Supporting Files: orders.xml
-->

<xsl:stylesheet 
   version="1.0" 
   xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
>
   <xsl:output 
      method="xml"
      version="1.0"
      indent="yes"
      doctype-system="customers.dtd"
   />
   <xsl:template match="/">
      <xsl:comment>
         Author: Eric Henderson
         Date: 12/1/25
      </xsl:comment>
      <xsl:element name="customers">
         <xsl:apply-templates select="orders/order">
            <xsl:sort select="@custid" />
         </xsl:apply-templates>
      </xsl:element>
   </xsl:template>
   <xsl:template match="order">
      <xsl:element name="customer">
         <xsl:attribute name="id">
            <xsl:value-of select="@custid" />
         </xsl:attribute>
         <xsl:element name="order">
            <xsl:attribute name="orderid">
               <xsl:value-of select="@id" />
            </xsl:attribute>
            <xsl:element name="qty">
               <xsl:value-of select="@qty" />
            </xsl:element>
            <xsl:element name="date">
               <xsl:value-of select="date" />
            </xsl:element>
            <xsl:element name="amount">
               <xsl:value-of select="amount" />
            </xsl:element>
         </xsl:element>
      </xsl:element>
   </xsl:template>
</xsl:stylesheet>