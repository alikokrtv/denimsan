Add-Type -AssemblyName System.Drawing
$files = @('c:\Users\aliko\denimsa\assets\img\collections\rigid.png', 'c:\Users\aliko\denimsa\assets\img\collections\superstrech.png')

foreach ($file in $files) {
    if (Test-Path $file) {
        $img = [System.Drawing.Image]::FromFile($file)
        # Crop 90 pixels from the bottom to ensure the watermark is gone
        $rect = New-Object System.Drawing.Rectangle(0, 0, $img.Width, ($img.Height - 90))
        $bmp = New-Object System.Drawing.Bitmap($rect.Width, $rect.Height)
        $g = [System.Drawing.Graphics]::FromImage($bmp)
        $g.DrawImage($img, 0, 0, $rect, [System.Drawing.GraphicsUnit]::Pixel)
        $g.Dispose()
        $img.Dispose()
        $tempFile = $file + '.tmp.png'
        $bmp.Save($tempFile, [System.Drawing.Imaging.ImageFormat]::Png)
        $bmp.Dispose()
        Move-Item -Path $tempFile -Destination $file -Force
        Write-Host "Cropped $file"
    } else {
        Write-Host "File not found: $file"
    }
}
