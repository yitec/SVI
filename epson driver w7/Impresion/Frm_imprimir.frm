VERSION 5.00
Begin VB.Form Frm_imprimir 
   Caption         =   "Form2"
   ClientHeight    =   2340
   ClientLeft      =   108
   ClientTop       =   432
   ClientWidth     =   3624
   LinkTopic       =   "Form2"
   ScaleHeight     =   2340
   ScaleWidth      =   3624
   StartUpPosition =   3  'Windows Default
   Begin VB.Timer Timer1 
      Interval        =   500
      Left            =   1560
      Top             =   480
   End
End
Attribute VB_Name = "Frm_imprimir"
Attribute VB_GlobalNameSpace = False
Attribute VB_Creatable = False
Attribute VB_PredeclaredId = True
Attribute VB_Exposed = False
Private Sub Timer1_Timer()
Dim rs As New ADODB.Recordset
Dim rs2 As New ADODB.Recordset

rs.Open "select * from tbl_facturas where impresa=0 LIMIT 1 ", db

If rs.EOF = False Then

    Dim sPrevAppTitle As String
    
    sPrevAppTitle = App.Title
    App.Title = "Testing"
    
    Printer.ScaleMode = vbPoints
    
    'Printer.PaintPicture Image1.Picture, 82, 0, , , , , , vbMergeCopy
    
    Printer.CurrentY = Printer.CurrentY + 22
    Printer.ScaleLeft = -12.5
            
    Printer.FontSize = 9.5
    Printer.FontName = "FontA11"
    
    Printer.Print ""
    Printer.Print "        NBC Travels S.A.     "
    Printer.Print "        TEL   2240-4060      "
    Printer.Print "       Ced: 3-101-5815-79    "
    Printer.Print "       " & Now() & " "
    Printer.Print ""
    Printer.Print "Cliente: " & rs!nombre
    Printer.Print ""
    Printer.Print "        Detalle          "
    Printer.Print "-------------------------"

    rs2.Open "select * from tbl_subfacturas where consecutivo='" & rs!consecutivo & "'", db
    
    While Not rs2.EOF

    
    Printer.Print "" & rs2!nombre & " "
    Printer.Print "                     " & rs2!precio
    Printer.Print ""
    
    rs2.MoveNext
    
    Wend
    
    Printer.Print "-------------------------"
    Printer.Print "Impuesto 13%:        3757"
    Printer.Print "Monto Total:        " & rs!monto_total
    
    Printer.Print "-------------------------"
    Printer.Print "  Gracias por su compra  "

    Printer.EndDoc
    
    App.Title = sPrevAppTitle


End If
rs.Close


End Sub
