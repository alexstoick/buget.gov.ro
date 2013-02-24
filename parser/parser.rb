require 'CSV'

class String
	def is_number?
		true if Float(self) rescue false
	end
end

dir = 'sources/anexa/'
Dir.glob(dir + '*.csv') do |file|
	next if file.start_with?(dir+'sinteza')

	csv = CSV.read(file)
	section = 'none'

	numeInstitutie = csv[0][0].to_s + " " + csv[1][0].to_s + " " + csv[2][0].to_s
	numeInstitutie.strip!.capitalize!

	idInstitutie = file
	idInstitutie.slice!(dir)
	idInstitutie = idInstitutie[0,2]

	idParinte = 0

	csv.each do |row|

		firstRow = row.first.to_s.strip
		section = firstRow if firstRow.to_s.is_number?

		unless section == 'none' or row[-2].nil?
			denumireIndicator = row[-2].to_s.strip
			suma = row[-1].to_s.strip

			puts idInstitutie + "," + idParinte.to_s + "," + section + "," +
					numeInstitutie + "," + denumireIndicator +
					',"' + suma + '"'
			idParinte = idInstitutie
		end

	end
end
